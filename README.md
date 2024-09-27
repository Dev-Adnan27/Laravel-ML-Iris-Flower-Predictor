# Iris Flower Predictor

This project is a **Machine Learning + Laravel** application that predicts the species of an Iris flower based on its sepal and petal dimensions. The project leverages the **K-Nearest Neighbors (KNN)** algorithm for classification and provides a simple web interface built using **Bulma CSS**.

## Features
- **Train the Model**: Using pre-labeled Iris flower dataset, the model is trained to classify flower species into *Setosa*, *Versicolor*, or *Virginica*.
- **Predict Flower Species**: Users can input sepal and petal dimensions (length and width) via a web form, and the model will predict the flower's species.
- **Model Persistence**: Once trained, the model is saved for later predictions without retraining.

## Tech Stack
- **Backend**: Laravel (PHP framework)
  - Machine Learning powered by **PHP-ML** (PHP Machine Learning Library).
- **Frontend**: 
  - **Blade Templates** for rendering.
  - **Bulma CSS** for a responsive and modern UI.
  - **Axios** for handling AJAX requests.
  
## How It Works
1. **Model Training**: A set of Iris flower data is fed to the KNN classifier, which is then trained to recognize patterns in the data.
2. **Prediction**: Once the model is trained and saved, users can predict the species by entering sepal and petal dimensions into a web form.
3. **REST API**: AJAX requests are sent to the Laravel backend, which loads the saved model and returns the predicted class.

## Getting Started
1. Clone the repository and navigate to the project directory.
2. Install the necessary dependencies:
   ```bash
   composer install
   npm install
   ```
3. Run the migrations and seeders (if applicable).
4. Start the local development server:
   ```bash
   php artisan serve
   ```

## Usage
1. **Train the Model**: Go to `/train` to train and save the model.
2. **Predict Species**: Access the prediction form at the homepage, enter the flower dimensions, and click **Predict** to see the results.

## Screenshot
- Simple and clean interface built with Bulma for the user to input sepal and petal details.
![image](https://github.com/user-attachments/assets/9384bc68-3490-487e-a1d7-2189bc9d6a18)


## License
This project is licensed under the MIT License.

-----------------------------------------------------------------------------------------------------------------------------------------------

Feel free to contribute to this project by submitting issues or pull requests! 😊

