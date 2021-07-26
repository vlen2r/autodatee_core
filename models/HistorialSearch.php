<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Historial;

/**
 * HistorialSearch represents the model behind the search form of `app\models\Historial`.
 */
class HistorialSearch extends Historial
{

    /**
     * Added by Batista 2021-07-26.
     * Filter by a camp of a related table.
     */
    /* attribute */
    public $clienteNombre;
    //end of the add by Batista 2021-07-26

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        
        /**
         * Agregado por Batista 2021-07-26
         * Para filtrar mediante el nombre del cliente.
         * Siendo cliente una tabla foranea de Historial.
         */
        parent::rules();
        //Fin del agregado Batista 2021-07-26
        return [
            [['id', 'cliente_id', 'cantidad'], 'integer'],
            [['fecha'], 'safe'],
            
        /**
         * Agregado por Batista 2021-07-26
         * Para filtrar mediante el nombre del cliente.
         * Siendo cliente una tabla foranea de Historial.
         */
            [['clienteNombre'], 'safe'],
        //Fin del agregado Batista 2021-07-26
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
        $query = Historial::find();

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

        /**
         * Agregado por Batista 2021-07-26
         * Para filtrar mediante el nombre del cliente.
         * Siendo cliente una tabla foranea de Historial.
         */
        $query->joinWith(['cliente']);

        //$query->andFilterWhere(['like', 'cliente.nombre', $this->cliente.nombre]);
        
        // Another example of filtering
        $query->joinWith(['cliente' => function ($q) {
                $q->where('nombre LIKE "%' . $this->clienteNombre . '%"');
        }]);

        //End of the add by Batista 2021-07-26

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cliente_id' => $this->cliente_id,
            'cantidad' => $this->cantidad,
            'fecha' => $this->fecha,
        ]);

        return $dataProvider;
    }
}
