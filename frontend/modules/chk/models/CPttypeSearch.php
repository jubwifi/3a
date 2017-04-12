<?php

namespace app\modules\chk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\chk\models\CPttype;

/**
 * CPttypeSearch represents the model behind the search form about `app\modules\chk\models\CPttype`.
 */
class CPttypeSearch extends CPttype
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pttype', 'name', 'hmain', 'chk_pttype', 'pp', 'sso', 'claim', 'null_sps', 'paist', 'aid', 'health', 'nhso_code', 'hipdata_code'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CPttype::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'pttype', $this->pttype])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'hmain', $this->hmain])
            ->andFilterWhere(['like', 'chk_pttype', $this->chk_pttype])
            ->andFilterWhere(['like', 'pp', $this->pp])
            ->andFilterWhere(['like', 'sso', $this->sso])
            ->andFilterWhere(['like', 'claim', $this->claim])
            ->andFilterWhere(['like', 'null_sps', $this->null_sps])
            ->andFilterWhere(['like', 'paist', $this->paist])
            ->andFilterWhere(['like', 'aid', $this->aid])
            ->andFilterWhere(['like', 'health', $this->health])
            ->andFilterWhere(['like', 'nhso_code', $this->nhso_code])
            ->andFilterWhere(['like', 'hipdata_code', $this->hipdata_code]);

        return $dataProvider;
    }
}
