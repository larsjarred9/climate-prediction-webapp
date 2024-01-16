<?php

// Check if enough arguments are provided to make prediction
if ($argc != 4) {
    echo "Usage: php index.php [temp] [hum] [frequency]\n";
    exit(1);
}

// if frequency is not a number and not between 25 and 50, exit
if ($argv[3] < 25 || $argv[3] > 50) {
    echo "Frequency must be between 25 and 100\n";
    exit(1);
}

// Assign arguments to variables
$temp = $argv[1];
$hum = $argv[2];
$frequency = $argv[3];
$predictions = [];

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

// Loop frequency times to get the most likely predictions
for ($i = 0; $i < $frequency; $i++) {
    // Get training data again to prevent faulty predictions
    $classification->train($dataset->getTrainSamples(), $dataset->getTrainLabels());

    // Predict
    $newPrediction = $classification->predict([$newInput]);

    // Add prediction to the predictions array
    $predictions[] = $newPrediction[0];
}

// Count the frequency of each prediction
$predictionCounts = array_count_values($predictions);

// Determine the most frequent prediction
$mostFrequentPrediction = array_search(max($predictionCounts), $predictionCounts);

// Print the most common prediction for the input
echo "Most frequent predictions is: " . $mostFrequentPrediction . "\n";

