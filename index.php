<?php

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

