<?php
namespace application\web\www\modules\user\controllers\upcheck;
use application\web\www\components\WwwBaseAction;

class IndexAction extends WwwBaseAction{
    public function run(){
//dd(11);
        return $this->render(compact(''));
    }
}