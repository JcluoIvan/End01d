<?php
namespace model;
use ActiveRecord\Model;

class MemberPointRecord extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'member_point_record';

    // explicit pk since our pk is not "id"
    static $primary_key = 'mpr001';//'mep001,mep002';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';
    

    # 軟刪除
    static $soft_delete = 'mpr006';
    
    const TYPE_ORDER = 'order';
    const TYPE_REGISTER = 'register';

    public function afterSave() 
    {

        $this->updateMemberPoint();

    }
    public function afterDelete()
    {
        $this->updateMemberPoint();
    }

    /** 更新會員購物金 */
    public function updateMemberPoint()
    {
        $mid = $this->mpr002;
        $options = array(
            'select' => 'IFNULL(SUM(mpr005), 0) AS point',
            'conditions' => array('mpr002 = ?', $mid),
        );
        $row = MemberPointRecord::find('first', $options);

        /* 更新此會員的購物金 (這裡不使用 ActiveRecord 的 save, 避免觸發 log 的記錄 */
        $values = array($row->point, $mid);
        $sql = "UPDATE `member` SET `mem021` = ? WHERE `mem001` = ?";
        return static::connection()->query($sql, $values);

    }

}