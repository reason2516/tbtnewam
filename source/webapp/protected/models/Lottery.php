<?php

/**
 * This is the model class for table "{{lottery}}".
 *
 * The followings are the available columns in table '{{lottery}}':
 * @property string $id
 * @property string $name
 * @property string $time_start
 * @property string $time_end
 * @property string $ctime
 */
class Lottery extends CActiveRecord {

    const STATUS_BEFORE = '1';
    const STATUS_DURING = '11';
    const STATUS_OVERDUE = '21';

    public $pageSize = 10;
    public $select = '*';

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{lottery}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, time_start, time_end, ctime', 'required'),
            array('name', 'length', 'max' => 40),
            array('time_end', 'checkTime'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, time_start, time_end, ctime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'LotteryItem' => array(self::HAS_MANY, 'LotteryItem', 'lottery_id', 'order' => 'LotteryItem.sort'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'id',
            'name' => '活动名称',
            'time_start' => '开始时间',
            'time_end' => '结束时间',
            'ctime' => '创建时间',
            'status' => '活动状态',
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
        $criteria->select = $this->select;
        $criteria->compare('id', $this->id);
//        $criteria->compare('name', $this->name, true);
//        $criteria->compare('time_start', $this->time_start, true);
//        $criteria->compare('time_end', $this->time_end, true);
//        $criteria->compare('ctime', $this->ctime, true);

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
     * @return Lottery the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 
     * @return type
     */
    public function beforeValidate() {
        $this->ctime = !empty($this->ctime) ? $this->ctime : date('Y-m-d H:i:s'); // 增加创建时间
        return parent::beforeValidate();
    }

    /**
     * 检测时间
     */
    public function checkTime($attribute, $params) {
        if (strtotime($this->time_end) <= strtotime($this->time_start)) {
            $this->addError($attribute, '结束时间应大于开始时间');
        }
    }

    public function statusList() {
        return array(
            self::STATUS_BEFORE => '未开始',
            self::STATUS_DURING => '进行中',
            self::STATUS_OVERDUE => '已结束'
        );
    }

    /**
     * 获取活动状态名称
     */
    public function getStatusName($timeStart, $timeEnd) {
        $statusList = $this->statusList();
        if (strtotime($timeStart) > time()) {
            return $statusList[self::STATUS_BEFORE];
        }
        if (strtotime($timeStart) < time() && strtotime($timeEnd) > time()) {
            return $statusList[self::STATUS_DURING];
        }
        if (strtotime($timeEnd) < time()) {
            return $statusList[self::STATUS_OVERDUE];
        }
    }

    /**
     * 获取活动状态
     */
    public function getStatus($timeStart, $timeEnd) {
        if (strtotime($timeStart) > time()) {
            return self::STATUS_BEFORE;
        }
        if (strtotime($timeStart) < time() && strtotime($timeEnd) > time()) {
            return self::STATUS_DURING;
        }
        if (strtotime($timeEnd) < time()) {
            return self::STATUS_OVERDUE;
        }
    }

    /**
     * 获取当前抽奖活动候选人名单
     * @param Member $memberModel
     * @param array $lotteryItems array()
     * @return array array('id' => realname)
     */
    public function getLcukyMembers(Member $memberModel = NULL) {
        $memberModel = !is_null($memberModel) ? $memberModel : Member::model();
        $members = CHtml::listData($memberModel->findAll('status = :status', array(':status' => Member::STATUS_NORMAL)), 'id', 'attributes'); // 所有具有正常状态的member array('id' => realname)
        $lotteryItems = $this->LotteryItem;
        if (!empty($lotteryItems)) {
            foreach ($lotteryItems as $lotteryItems) {
                foreach ($lotteryItems->Member as $member) {
                    array_key_exists($member->id, $members); // 去除当前活动下已获奖的候选人
                    unset($members[$member->id]);
                }
            }
        }

        return $members;
    }

}
