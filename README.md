# PHP Weather Prediction Model

## Overview

This project is a simple PHP-based machine learning application that predicts weather conditions based on temperature and humidity inputs. It utilizes the K-Nearest Neighbors (KNN) algorithm for classification. The model is trained on a dataset containing historical weather data, and it predicts the weather condition for new input data.

## Dependencies

-   PHP 7.4 or higher
-   Composer: A dependency manager for PHP.
-   Phpml: A machine learning library for PHP.

## Installation

1.  **Install PHP and Composer**: Ensure you have PHP and Composer installed on your system. You can download Composer from getcomposer.org.
    
2.  **Clone the Repository**: Clone this repository to your local machine or download the source code.
    
    `git  clone  https://github.com/your-repository/weather-prediction.git`
    
3.  **Install Dependencies**: Navigate to the project directory and install the required PHP packages.
  
    
    `cd  weather-prediction | bash php composer.phar install`
    
4.  **Prepare the Dataset**: Ensure you have the dataset (`data.csv`) in the `data` directory. The CSV file should have temperature, humidity, and weather condition data.
    

## Usage

To run the prediction model, use the following command from the root of the project directory:

`php index.php [temperature] [humidity] [frequency]`

Replace `[temperature]` , `[humidity]` and `[frquency]` with the respective values for which you want to predict the weather condition.

Example:

`php index.php 10.12 990 25`

This command will output the accuracy of the model based on the test set and the prediction for the provided temperature and humidity values.

## How It Works

-   The script first checks if the correct number of arguments are provided.
-   It then loads the dataset from a CSV file.
-   The dataset is split into training and testing sets.
-   A KNN classifier is trained with the training set.
-   The model's accuracy is evaluated using the test set.
-   Finally, the model predicts the weather condition for a new set of temperature and humidity values.

## License

Feel free to use any of the code as this was part of a school-project.

----------

This readme file was generated with help from GitHUB Codepilot.
