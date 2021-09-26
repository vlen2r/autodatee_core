<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Importacion;
use app\models\Cliente;

/**
 * ImportacionSearch represents the model behind the search form of `app\models\Importacion`.
 */
class ImportacionSearch extends Importacion
{
    public $clienteNombre;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        parent::rules();
        return [
            [['id', 'importado'], 'integer'],
            [['nombre', 'apellido', 'telefono', 'celular', 'direccion', 'email', 'auto', 'observaciones', 'token'], 'safe'],
            [['cliente_id'], 'integer'],
            [['clienteNombre'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Importacion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['cliente']);
            return $dataProvider;
        }

        $query->joinWith(['cliente' => function ($q) {
            $q->where('cliente.nombre LIKE "%' . $this->clienteNombre . '%"');
        }]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'importado' => $this->importado,
            'cliente_id' => $this->cliente_id,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'celular', $this->celular])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'auto', $this->auto])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones])
            ->andFilterWhere(['like', 'token', $this->token]);

        $query->orderBy(['fecha' => SORT_DESC]);

        return $dataProvider;
    }
}
