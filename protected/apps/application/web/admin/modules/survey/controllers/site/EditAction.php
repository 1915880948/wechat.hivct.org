<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 19/11/2017 00:00
 * @since
 */

namespace application\web\admin\modules\survey\controllers\site;

use application\models\base\Express;
use application\models\base\OrderList;
use application\models\base\SurveyList;
use application\models\base\UserEvent;
use application\models\service\BaseService;
use application\web\admin\components\AdminBaseAction;

class EditAction extends AdminBaseAction
{
    public function run($uuid='')
    {
        if (\Yii::$app->request->isPost) {
            \Yii::$app->response->format = 'json';
            $postData = \Yii::$app->request->post();
            $surveyModel = SurveyList::find()->andWhere(['uuid' => $postData['uuid']])->one();
            $surveyModel->name                         = $postData['name'];
            $surveyModel->nation                       = $postData['nation'];
            $surveyModel->gender                       = $postData['gender'];
            $surveyModel->education                    = $postData['education'];
            $surveyModel->marriage                     = $postData['marriage'];
            $surveyModel->job                          = $postData['job'];
            $surveyModel->job_other                    = $postData['job_other'];
            $surveyModel->income                       = $postData['income'];
            $surveyModel->household                    = $postData['household'];
            $surveyModel->livecity                     = $postData['livecity'];
            $surveyModel->livecity_code                = $postData['livecity_code'];
            $surveyModel->livetime                     = $postData['livetime'];
            $surveyModel->has_sex                      = $postData['has_sex'];
            $surveyModel->sex_age                      = $postData['sex_age'];
            $surveyModel->partner                      = $postData['partner'];
            $surveyModel->partner_sns                  = $postData['partner_sns'];
            $surveyModel->partner_bar                  = $postData['partner_bar'];
            $surveyModel->partner_ktv                  = $postData['partner_ktv'];
            $surveyModel->partner_park                 = $postData['partner_park'];
            $surveyModel->partner_other                = $postData['partner_other'];
            $surveyModel->sex_type                     = $postData['sex_type'];
            $surveyModel->sex_type_other               = $postData['sex_type_other'];
            $surveyModel->sex_direction                = $postData['sex_direction'];
            $surveyModel->has_sex_3month               = $postData['has_sex_3month'];
            $surveyModel->hetero_partner_num           = $postData['hetero_partner_num'];
            $surveyModel->condom_full_use              = $postData['condom_full_use'];
            $surveyModel->condom_percent               = $postData['condom_percent'];
            $surveyModel->condom_near                  = $postData['condom_near'];
            $surveyModel->condom_full_use_not          = $postData['condom_full_use_not'];
            $surveyModel->anal_sex                     = $postData['anal_sex'];
            $surveyModel->anal_sex_role                = $postData['anal_sex_role'];
            $surveyModel->anal_sex_partner_num         = $postData['anal_sex_partner_num'];
            $surveyModel->anal_sex_full_use            = $postData['anal_sex_full_use'];
            $surveyModel->anal_sex_percent             = $postData['anal_sex_percent'];
            $surveyModel->anal_sex_near                = $postData['anal_sex_near'];
            $surveyModel->anal_sex_full_use_not        = $postData['anal_sex_full_use_not'];
            $surveyModel->is_use_drug                  = $postData['is_use_drug'];
            $surveyModel->drug_type                    = $postData['drug_type'];
            $surveyModel->drug_rate                    = $postData['drug_rate'];
            $surveyModel->is_use_drug_near_month       = $postData['is_use_drug_near_month'];
            $surveyModel->drug_near_month_num          = $postData['drug_near_month_num'];
            $surveyModel->is_use_inject                = $postData['is_use_inject'];
            $surveyModel->is_use_inject_near_month     = $postData['is_use_inject_near_month'];
            $surveyModel->inject_near_month_num        = $postData['inject_near_month_num'];
            $surveyModel->is_use_pinhead               = $postData['is_use_pinhead'];
            $surveyModel->is_use_pinhead_near_month    = $postData['is_use_pinhead_near_month'];
            $surveyModel->pinhead_near_month_num       = $postData['pinhead_near_month_num'];
            $surveyModel->is_sex_after_drug_3month     = $postData['is_sex_after_drug_3month'];
            $surveyModel->sex_after_drug_3month_num    = $postData['sex_after_drug_3month_num'];
            $surveyModel->is_sex_after_drug_1month     = $postData['is_sex_after_drug_1month'];
            $surveyModel->sex_after_drug_1month_num    = $postData['sex_after_drug_1month_num'];
            $surveyModel->cough_2week                  = $postData['cough_2week'];
            $surveyModel->cough_withblood              = $postData['cough_withblood'];
            $surveyModel->sweat_on_night               = $postData['sweat_on_night'];
            $surveyModel->weight_downgrade             = $postData['weight_downgrade'];
            $surveyModel->always_tired                 = $postData['always_tired'];
            $surveyModel->fever_2week                  = $postData['fever_2week'];
            $surveyModel->lymphadenectasis             = $postData['lymphadenectasis'];
            $surveyModel->tuberculosis_contact_history = $postData['tuberculosis_contact_history'];
            $surveyModel->no_tuberculosis              = $postData['no_tuberculosis'];
            $surveyModel->is_phthisic_checked          = $postData['is_phthisic_checked'];
            $surveyModel->phthisic_result              = $postData['phthisic_result'];
            $surveyModel->is_syphilis                  = $postData['is_syphilis'];
            $surveyModel->syphilis_result              = $postData['syphilis_result'];
            $surveyModel->is_hepatitis_b               = $postData['is_hepatitis_b'];
            $surveyModel->hepatitis_b_result           = $postData['hepatitis_b_result'];
            $surveyModel->is_hepatitis_c               = $postData['is_hepatitis_c'];
            $surveyModel->hepatitis_c_result           = $postData['hepatitis_c_result'];
            $surveyModel->detect_hospital              = $postData['detect_hospital'];
            $surveyModel->detect_jk_center             = $postData['detect_jk_center'];
            $surveyModel->detect_community             = $postData['detect_community'];
            $surveyModel->detect_drugstore             = $postData['detect_drugstore'];
            $surveyModel->detect_clinic                = $postData['detect_clinic'];
            $surveyModel->detect_other                 = $postData['detect_other'];
            $surveyModel->is_accept_detect_hiv         = $postData['is_accept_detect_hiv'];
            $surveyModel->detect_num                   = $postData['detect_num'];
            $surveyModel->detect_num_near_1year        = $postData['detect_num_near_1year'];
            $surveyModel->detect_num_near_6month       = $postData['detect_num_near_6month'];
            $surveyModel->is_know_detect_result        = $postData['is_know_detect_result'];
            $surveyModel->hiv_check_mode               = $postData['hiv_check_mode'];
            $surveyModel->hiv_check_reason             = $postData['hiv_check_reason'];
            $surveyModel->hiv_check_reason_other       = $postData['hiv_check_reason_other'];
            $surveyModel->last_hiv_check_mode          = $postData['last_hiv_check_mode'];
            $surveyModel->last_hiv_check_mode_other    = $postData['last_hiv_check_mode_other'];
            $surveyModel->is_detect_care               = $postData['is_detect_care'];
            $surveyModel->hiv_check_care               = $postData['hiv_check_care'];
            $surveyModel->hiv_check_care_other         = $postData['hiv_check_care_other'];
            $surveyModel->detect_channel_hospital      = $postData['detect_channel_hospital'];
            $surveyModel->detect_channel_jk_center     = $postData['detect_channel_jk_center'];
            $surveyModel->detect_channel_community     = $postData['detect_channel_community'];
            $surveyModel->detect_channel_drugstore     = $postData['detect_channel_drugstore'];
            $surveyModel->detect_channel_clinic        = $postData['detect_channel_clinic'];
            $surveyModel->detect_channel_other         = $postData['detect_channel_other'];
            $surveyModel->detect_by_self               = $postData['detect_by_self'];
            $surveyModel->hiv_check_time               = $postData['hiv_check_time'];
            $surveyModel->apply_for_free               = $postData['apply_for_free'];
            $surveyModel->partner_is_check_hiv         = $postData['partner_is_check_hiv'];
            $surveyModel->partner_check_result         = $postData['partner_check_result'];
            $surveyModel->partner_mobilize             = $postData['partner_mobilize'];
            $surveyModel->fast_detect_service          = $postData['fast_detect_service'];
            $surveyModel->org_for_cd4                  = $postData['org_for_cd4'];
            $surveyModel->org_therapy                  = $postData['org_therapy'];
            $surveyModel->org_syphilis                 = $postData['org_syphilis'];
            $surveyModel->org_syphilis_other           = $postData['org_syphilis_other'];
            $surveyModel->org_psychological            = $postData['org_psychological'];
            $surveyModel->org_pmtct                    = $postData['org_pmtct'];
            $surveyModel->org_phthisis                 = $postData['org_phthisis'];
            $surveyModel->org_other                    = $postData['org_other'];
            $surveyModel->active_treatment             = $postData['active_treatment'];
            $surveyModel->unaccept_medical             = $postData['unaccept_medical'];
            $surveyModel->treatment_until_standard     = $postData['treatment_until_standard'];
            $surveyModel->resistant_care               = $postData['resistant_care'];
            $surveyModel->explore_care                 = $postData['explore_care'];
            $surveyModel->not_treatment                = $postData['not_treatment'];
            $surveyModel->treatment_other              = $postData['treatment_other'];

            if($surveyModel->save()){
                return ['code'=>200,'message'=>'success'];
            }else{
                return ['code'=>500,'message'=>$surveyModel->getErrors()];
            }

        }
        $express = Express::find()->andWhere(['status' => 1])->asArray()->all();
        $data = SurveyList::find()->andWhere(['uuid' => $uuid])->asArray()->one();
        $order_data = OrderList::find()
            ->from(OrderList::tableName() . ' as ol')
            ->leftJoin(SurveyList::tableName() . ' as sl', 'ol.source_uuid=sl.uuid')
            ->andWhere(['sl.uuid' => $uuid])
            ->asArray()
            ->one();
        $eventInfo = UserEvent::find()
            ->andWhere(['event_type' => 'survey'])
            ->andWhere(['event_type_uuid' => $uuid])
            ->one();
        if ($eventInfo && $order_data) {
            if (!$eventInfo['order_uuid'] && $order_data['uuid']) {
                $eventInfo['order_uuid'] = $order_data['uuid'];
                $eventInfo['order_is_paid'] = $order_data['pay_status'];
                $eventInfo->save();
            }
        }

        $ship = array_column($express, 'name', 'id');
        $options = (new BaseService())->options;

        return $this->render(compact('options', 'data', 'order_data'));
    }
}
