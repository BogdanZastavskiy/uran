<?php
namespace app\widgets;

use Yii;

/**
 * Description of MyWidget
 *
 * @author user
 */
class MyWidget extends \yii\bootstrap\Widget {
    
    private $viewFilePath;
    
    public $a;

    public function init() {
        parent::init();
        $this->viewFilePath = Yii::getAlias('@app/views/widgets/my.php');
    }
    
    private function registerAssets() {
        \app\assets\MyWidgetAsset::register($this->view);
    }

    public function run() {
        
        $this->registerAssets();
        echo $this->renderFile($this->viewFilePath, [
            
        ]);
    }
    
}
