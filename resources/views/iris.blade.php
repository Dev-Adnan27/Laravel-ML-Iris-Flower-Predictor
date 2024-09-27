<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iris Flower Predictor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        * {
            overflow: hidden !important;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f9;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hero {
            background-color: #ff4757;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
            width: 100%;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #ff4757;
            font-size: larger;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            padding: 10px 0;
        }

        .form-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .form-container {
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
        }

        .label {
            color: #ff4757;
            font-weight: bold;
        }

        .notification {
            background-color: #dff9d8;
            border: 1px solid #4caf50;
            font-size: 1.2rem;
            margin-top: 20px;
        }

        #predictForm,
        input[type='number'] {
            background-color: #f7f7f7;
        }

        h2.subtitle {
            margin-bottom: 2rem;
            color: #333;
        }

        .button.is-primary {
            background-color: #ff4757;
            border-color: #ff4757;
            transition: all 0.2s ease;
            color: white;
        }

        .button.is-primary:hover {
            background-color: #e43e40;
        }

        @media (max-width: 768px) {
            .columns.is-centered {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .form-container {
                padding: 1rem;
            }
        }

        @media (min-width: 769px) {
            .columns.is-centered {
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        .column {
            flex: 1;
            max-width: 45%;
        }
    </style>
</head>

<body>
    <section class="hero">
        <div class="hero-body">
            <h1 class="title has-text-light">Iris Flower Predictor</h1>
        </div>
    </section>
    <section class="form-section">
        <div class="form-container">
            <h2 class="subtitle has-text-centered">Enter the dimensions of the Iris flower's sepals and petals:</h2>
            <form id="predictForm">
                <div class="columns is-centered">
                    <div class="column">
                        <div class="field">
                            <label class="label" for="sepal_length">Sepal Length (cm):</label>
                            <div class="control">
                                <input class="input" type="number" name="sepal_length" step="0.1" placeholder="e.g. 5.1" required>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label" for="sepal_width">Sepal Width (cm):</label>
                            <div class="control">
                                <input class="input" type="number" name="sepal_width" step="0.1" placeholder="e.g. 3.5" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="columns is-centered">
                    <div class="column">
                        <div class="field">
                            <label class="label" for="petal_length">Petal Length (cm):</label>
                            <div class="control">
                                <input class="input" type="number" name="petal_length" step="0.1" placeholder="e.g. 1.4" required>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label" for="petal_width">Petal Width (cm):</label>
                            <div class="control">
                                <input class="input" type="number" name="petal_width" step="0.1" placeholder="e.g. 0.2" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field has-text-centered">
                    <div class="control">
                        <button class="button is-primary is-large" type="submit">Predict</button>
                    </div>
                </div>
            </form>
            <div id="result" class="notification" style="display: none;"></div>
        </div>
    </section>
    <footer class="has-text-light">
        &copy; Created With &hearts; by Dev Adnan
    </footer>
    <script>
        document.getElementById('predictForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const csrfToken = '{{ csrf_token() }}';

            axios.post('{{ url("/predict") }}', formData, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-Token': csrfToken
                    }
                })
                .then(response => {
                    document.getElementById('result').innerText = 'Predicted Class: ' + response.data.predicted_class;
                    document.getElementById('result').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    const errorMessage = error.response?.data?.message || error.message || 'An error occurred';
                    document.getElementById('result').innerText = 'Error: ' + errorMessage;
                    document.getElementById('result').style.display = 'block';
                    document.getElementById('result').classList.add('is-danger');
                });
        });
    </script>
</body>

</html>
