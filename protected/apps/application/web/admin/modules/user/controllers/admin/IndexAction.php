<?php
namespace application\web\admin\modules\user\controllers\admin;

use application\models\base\Logistics;
use application\web\admin\AdminUser;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;
use qiqi\helper\MessageHelper;

/**
 * Class LoginAction
 * @package admin\controllers\site
 */
class IndexAction extends AdminBaseAction
{
    public function run($id = 0)
    {
        if( !$this->userinfo['is_admin'] ){
            return MessageHelper::success('对不起，您没有权限！');
        }
        $logistic = Logistics::find()
            ->andWhere(['status'=>1])
            ->asArray()
            ->all();
        $model = AdminUser::findByPk($id);
        if (!$model) {
            $model = new AdminUser();
            $model->loadDefaultValues();
        }
        if ( $this->request->getIsPost() ) {
            $postData = $this->request->post();
            $is_exist = AdminUser::find()
                ->andWhere(['<>','aid',$postData['id']])
                ->andWhere(['account'=>$postData['account']])->one();
            if( $is_exist ){
                return MessageHelper::error("此账户已经存在！！");
            }
            if( trim($postData['password'],' ') ) {
                $hash = \Yii::$app->getSecurity()->generatePasswordHash( trim($postData['password'],' '));
                $model->password = $hash;
            }
            $model->account = $postData['account'];
            $model->nickname = $postData['nickname'];
            $model->is_admin = $postData['is_admin'];
            $model->logistic_id = $postData['logistic_id'];
            if($model->save()){
                if( !$this->userinfo['is_admin'] ){
                    return MessageHelper::success(($id?"编辑":"新增")."成功",yUrl('/'));
                }
                return MessageHelper::success(($id?"编辑":"新增")."成功");
            }else{
                return $model->getErrors();
            }
        }
        $query = AdminUser::find()
            ->andWhere(['<>','aid',1])
            ->orderBy(['aid' => SORT_ASC]);
        $provider = DataProviderHelper::create($query);

        return $this->render(compact('provider', 'model','logistic'));
    }
}
