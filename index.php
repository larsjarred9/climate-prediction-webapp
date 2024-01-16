<?php

// Check if enough arguments are provided to make prediction
if ($argc != 3) {
    echo "Usage: php index.php [temp] [hum]\n";
    exit(1);
}

// Assign arguments to variables
$temp = $argv[1];
$hum = $argv[2];

// Load Composer components
require "vendor/autoload.php";

// Load dataset from CSV
$data = new Phpml\Dataset\CsvDataset('data/data.csv', 2, true);

// Split dataset into training and test sets
$dataset = new Phpml\CrossValidation\StratifiedRandomSplit($data, 0.2);

// Clafify dataset
$classification = new Phpml\Classification\KNearestNeighbors(12);
$classification->train($dataset->getTrainSamples(), $dataset->getTrainLabels());

// Predict
$predicted = $classification->predict($dataset->getTestSamples());

// Calculate accuracy
$accuracy = \Phpml\Metric\Accuracy::score($dataset->getTestLabels(), $predicted);

// Print result
echo "Accuracy: " . $accuracy."\n";

// New input for prediction
$newInput = [$temp, $hum];

// Predict for the new input
$newPrediction = $classification->predict([$newInput]);

// Print new prediction
echo "Prediction for new input: " . $newPrediction[0];

