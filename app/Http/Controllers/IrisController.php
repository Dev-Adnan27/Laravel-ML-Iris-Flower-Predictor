<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phpml\Classification\KNearestNeighbors;
use Phpml\ModelManager;

class IrisController extends Controller
{
    private $classifier;

    public function __construct()
    {
        $this->classifier = new KNearestNeighbors();
    }

    public function train()
    {
        $samples = [
            [5.1, 3.5, 1.4, 0.2],
            [4.9, 3.0, 1.4, 0.2],
            [4.7, 3.2, 1.3, 0.2],
            [4.6, 3.1, 1.5, 0.2],
            [5.0, 3.6, 1.4, 0.2],
            [5.4, 3.9, 1.7, 0.4],
            [4.6, 3.4, 1.4, 0.3],
            [5.0, 3.4, 1.5, 0.2],
            [4.4, 2.9, 1.4, 0.2],
            [4.9, 3.1, 1.5, 0.1],
            [5.7, 4.4, 1.5, 0.4],
            [5.8, 4.0, 1.2, 0.2],
            [6.0, 2.2, 5.0, 1.5],
            [5.6, 2.5, 3.9, 1.1],
            [5.7, 3.8, 1.7, 0.3],
            [5.8, 2.7, 4.1, 1.0],
            [6.3, 2.5, 4.9, 1.5],
            [6.5, 3.0, 5.2, 2.0],
            [7.2, 3.6, 6.1, 2.5],
            [6.4, 2.9, 5.5, 1.8],
            [6.9, 3.1, 5.4, 2.1],
            [5.5, 2.4, 3.8, 1.1],
            [6.5, 3.0, 5.5, 1.8],
            [5.7, 2.8, 4.1, 1.3],
            [5.4, 3.4, 1.5, 0.4],
        ];

        $labels = [
            'setosa',
            'setosa',
            'setosa',
            'setosa',
            'setosa',
            'setosa',
            'setosa',
            'setosa',
            'setosa',
            'setosa',
            'versicolor',
            'versicolor',
            'virginica',
            'virginica',
            'virginica',
            'versicolor',
            'versicolor',
            'versicolor',
            'virginica',
            'virginica',
            'versicolor',
            'virginica',
            'virginica',
            'versicolor',
            'versicolor',
        ];
        $this->classifier->train($samples, $labels);
        $modelManager = new ModelManager();
        $modelManager->saveToFile($this->classifier, 'iris_model.phpml');

        return response()->json(['message' => 'Model trained and saved!']);
    }

    public function predict(Request $request)
    {
        $data = $request->validate([
            'sepal_length' => 'required|numeric',
            'sepal_width' => 'required|numeric',
            'petal_length' => 'required|numeric',
            'petal_width' => 'required|numeric',
        ]);
        $modelManager = new ModelManager();
        $this->classifier = $modelManager->restoreFromFile('iris_model.phpml');
        $prediction = $this->classifier->predict([
            $data['sepal_length'],
            $data['sepal_width'],
            $data['petal_length'],
            $data['petal_width']
        ]);
        return response()->json([
            'predicted_class' => $prediction
        ]);
    }
}
