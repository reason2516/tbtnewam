<?php

/**
 * This is the model class for table "{{member}}".
 *
 * The followings are the available columns in table '{{member}}':
 * @property string $id
 * @property string $realname
 * @property string $job_number
 * @property string $phonenumber
 * @property string $status
 */
class Member extends CActiveRecord {

    // member status
    const STATUS_NORMAL = 1;
    const STATUS_PAUSAL = 2;
    const STATUS_DELETE = 11;
    const STATUS_DELETE_COMPLETE = 12;
    
    public $pageSize = 10;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{member}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('realname, job_number, phonenumber', 'required'),
            array('realname, job_number', 'length', 'max' => 10),
            array('phonenumber, job_number', 'unique'),
            array('phonenumber', 'length', 'max' => 11),
            array('phonenumber', 'match', 'pattern' => '/^1[3|5|8]\d{9}$/', 'message' => '请输入正确的手机号码'),
            array('status', 'length', 'max' => 3),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, realname, job_number, phonenumber, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'id',
            'realname' => '成员姓名',
            'job_number' => '工号',
            'phonenumber' => '手机号码',
            'status' => '账户状态', // ： 1正常 2暂停 11删除 12彻底删除
        );
    }
    
    /**
     * 全部状态描述
     * @return type
     */
    public function statusList() {
        return array(
            self::STATUS_NORMAL => '正常',
            self::STATUS_PAUSAL => '暂停使用',
            self::STATUS_DELETE => '删除',
        );
    }
    
    /**
     * 状态描述
     * @param type $status
     * @return type
     */
    public function getStatusName($status){
        $statusList = $this->statusList();
        return isset($statusList[$status]) ? $statusList[$status] : $status;
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
        $criteria->compare('id', $this->id);
        $criteria->compare('realname', $this->realname);
        $criteria->compare('job_number', $this->job_number);
        $criteria->compare('phonenumber', $this->phonenumber);
        $criteria->compare('status', $this->status);

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
     * @return Member the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
