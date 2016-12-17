<?php

/**
 * This is the model class for table "{{lottery_item}}".
 *
 * The followings are the available columns in table '{{lottery_item}}':
 * @property string $id
 * @property string $name
 * @property string $lottery_id
 * @property string $total
 * @property string $sort
 */
class LotteryItem extends CActiveRecord {

    public $pageSize = 10;
    public $lotteryHandlerError;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{lottery_item}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, lottery_id, total', 'required'),
            array('name', 'length', 'max' => 40),
            array('lottery_id', 'length', 'max' => 10),
            array('total, sort', 'length', 'max' => 4),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, lottery_id, total, sort', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Lottery' => array(self::BELONGS_TO, 'Lottery', '', 'on' => 't.lottery_id = lottery.id'),
            'Member' => array(self::MANY_MANY, 'Member', 'am_lottery_result(lottery_item_id, member_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'id',
            'name' => '奖项名称',
            'lottery_id' => '归属抽奖活动id',
            'total' => '数量',
            'sort' => '抽奖顺序',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('lottery_id', $this->lottery_id);
        $criteria->order = 't.sort asc, id desc';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $this->pageSize,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return LotteryItem the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 抽奖控制器
     * $this->Member 当前项目已经获奖的人
     * $member 所有抽奖的候选人
     */
    public function lotteryHandler($members) {
        if (count($this->Member) >= $this->total || empty($members)) {
            $this->addError('lotteryHandlerError', '当前奖项已全部抽取完毕，请勿重复抽取');
            return FALSE;
        }
        $randomMembers = array();
        if (count($members) > ($this->total - count($this->Member))) { // 参与人数 > 奖项设置人数 - 已获奖人数
            $randomId = array_rand($members, $this->total - count($this->Member)); // 随机抽取
            if (is_array($randomId)) {
                foreach ($randomId as $id) {
                    $randomMembers[$id] = $members[$id];
                }
            } else {
                $randomMembers[$randomId] = $members[$randomId];
            }
        } else {
            $randomMembers = $members;
        }
        
        $lotterResult = new LotteryResult();
        foreach($randomMembers as $member){
            $lotterResult->isNewRecord = TRUE;
            $lotterResult->lottery_item_id = $this->id;
            $lotterResult->member_id = $member['id'];
            $lotterResult->save();
        }
        
        return $randomMembers;
    }

}
