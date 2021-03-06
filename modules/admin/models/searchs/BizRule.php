<?php

namespace hscstudio\heart\modules\admin\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use hscstudio\heart\modules\admin\models\BizRule as MBizRule;
use hscstudio\heart\modules\admin\components\AccessHelper;

/**
 * Description of BizRule
 *
 * @author MDMunir
 */
class BizRule extends Model
{
    /**
     * @var string name of the rule
     */
    public $name;

    public function rules()
    {
        return [
            [['name'], 'safe']
        ];
    }

    /**
     * 
     * @param array $params
     * @return \yii\data\ActiveDataProvider|\yii\data\ArrayDataProvider
     */
    public function search($params)
    {
        /* @var \yii\rbac\Manager $authManager */
        $authManager = Yii::$app->authManager;
        $models = [];
        $included = !($this->load($params) && $this->validate() && trim($this->name) !== '');
        foreach ($authManager->getRules() as $name => $item) {
            if ($name != AccessHelper::ROUTE_RULE_NAME && ($included || stripos($item->name, $this->name) !== false)) {
                $models[$name] = new MBizRule($item);
            }
        }
        return new ArrayDataProvider([
            'allModels' => $models,
        ]);
    }
}