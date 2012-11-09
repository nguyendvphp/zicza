<?php

Yii::import('zii.widgets.CPortlet');

class ListHotNewsWidget extends CPortlet {

    public function init() {
        return parent::init();
    }

    public function run() {
        
        $dataProvider=new CActiveDataProvider('News',array(
            'criteria'=>array(
                'condition'=>"status = 1",
                'order'=>'created_time DESC',
                'limit' => '6',
            )
        ));
       //var_dump($dataProvider);
        //$dataProvider->pagination->pageSize=5;
        $this->render(Yii::app()->params['web_path'].'views.wNews.hotnews',
                array('dataProvider'=>$dataProvider)
        );
        return parent::run();
    }
    

}

?>
