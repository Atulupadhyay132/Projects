from flask import Flask, render_template, request, jsonify
import pickle
import numpy as np
import os
from datetime import datetime

# ============================================================
# FLASK APPLICATION
# ============================================================

app = Flask(__name__)

app.config['SECRET_KEY'] = 'fraud-detection-secret-2024'


# ============================================================
# PROJECT PATH
# ============================================================

# Project structure:
#
# fraud-detection-project/
#
# ├── models/
# │   ├── fraud_model.pkl
# │   └── scaler.pkl
# │
# └── app/
#     ├── app.py
#     └── templates/
#         └── index.html

BASE_DIR = os.path.dirname(
    os.path.dirname(
        os.path.abspath(__file__)
    )
)


# ============================================================
# MODEL PATH
# ============================================================

MODEL_PATH = os.path.join(
    BASE_DIR,
    'models',
    'fraud_model.pkl'
)

SCALER_PATH = os.path.join(
    BASE_DIR,
    'models',
    'scaler.pkl'
)


# ============================================================
# LOAD ML MODEL AND SCALER
# ============================================================

model = None
scaler = None

try:

    with open(MODEL_PATH, 'rb') as f:
        model = pickle.load(f)

    with open(SCALER_PATH, 'rb') as f:
        scaler = pickle.load(f)

    print("=" * 60)
    print("MODEL LOADED SUCCESSFULLY")
    print("=" * 60)

    print("Model:")
    print(MODEL_PATH)

    print("Scaler:")
    print(SCALER_PATH)

    print("=" * 60)

except Exception as e:

    print("=" * 60)
    print("ERROR LOADING MODEL")
    print("=" * 60)

    print(e)

    print("=" * 60)


# ============================================================
# TRANSACTION HISTORY
# ============================================================

transaction_history = []


# ============================================================
# HOME PAGE
# ============================================================

@app.route('/')
def index():

    return render_template('index.html')


# ============================================================
# PREDICTION PAGE
# ============================================================

@app.route('/predict', methods=['GET'])
def prediction_page():

    return render_template('predict.html')


# ============================================================
# FRAUD PREDICTION API
# ============================================================

@app.route('/predict', methods=['POST'])
def predict():

    try:

        # ----------------------------------------------------
        # CHECK MODEL
        # ----------------------------------------------------

        if model is None or scaler is None:

            return jsonify({
                'success': False,
                'error': 'ML model or scaler is not loaded.'
            }), 500


        # ----------------------------------------------------
        # GET JSON DATA
        # ----------------------------------------------------

        data = request.get_json()

        if not data:

            return jsonify({
                'success': False,
                'error': 'No transaction data provided.'
            }), 400


        # ----------------------------------------------------
        # GET AMOUNT
        # ----------------------------------------------------

        amount = float(
            data.get('amount', 0)
        )


        # ----------------------------------------------------
        # CREATE 30 FEATURES
        # ----------------------------------------------------

        features = []

        for i in range(30):

            value = float(
                data.get(
                    f'feature_{i}',
                    0
                )
            )

            features.append(value)


        # ----------------------------------------------------
        # LAST FEATURE = AMOUNT
        # ----------------------------------------------------

        features[29] = amount


        # ----------------------------------------------------
        # CONVERT TO NUMPY ARRAY
        # ----------------------------------------------------

        features = np.array(
            [features],
            dtype=float
        )


        # ----------------------------------------------------
        # SCALE FEATURES
        # ----------------------------------------------------

        features_scaled = scaler.transform(
            features
        )


        # ----------------------------------------------------
        # MODEL PREDICTION
        # ----------------------------------------------------

        prediction = model.predict(
            features_scaled
        )[0]


        # ----------------------------------------------------
        # PREDICTION PROBABILITY
        # ----------------------------------------------------

        probability = model.predict_proba(
            features_scaled
        )[0]


        # ----------------------------------------------------
        # FRAUD STATUS
        # ----------------------------------------------------

        is_fraud = bool(prediction)


        fraud_probability = float(
            probability[1]
        ) * 100


        genuine_probability = float(
            probability[0]
        ) * 100


        # ----------------------------------------------------
        # TRANSACTION STATUS
        # ----------------------------------------------------

        if is_fraud:

            status = 'FRAUD'
            message = 'FRAUD DETECTED!'

        else:

            status = 'GENUINE'
            message = 'Transaction Genuine'


        # ----------------------------------------------------
        # TRANSACTION RECORD
        # ----------------------------------------------------

        transaction_record = {

            'time': datetime.now().strftime(
                '%Y-%m-%d %H:%M:%S'
            ),

            'amount': amount,

            'prediction': status,

            'confidence': f'{fraud_probability:.2f}%'

        }


        # ----------------------------------------------------
        # SAVE HISTORY
        # ----------------------------------------------------

        transaction_history.append(
            transaction_record
        )


        # Keep only last 20 transactions

        if len(transaction_history) > 20:

            transaction_history.pop(0)


        # ----------------------------------------------------
        # RETURN RESULT
        # ----------------------------------------------------

        return jsonify({

            'success': True,

            'fraud': is_fraud,

            'probability': fraud_probability,

            'genuine_probability': genuine_probability,

            'message': message,

            'confidence': f'{fraud_probability:.2f}%',

            'amount': amount

        })


    except Exception as e:

        print("Prediction Error:", e)

        return jsonify({

            'success': False,

            'error': str(e)

        }), 500


# ============================================================
# TRANSACTION HISTORY API
# ============================================================

@app.route('/history')
def history():

    return jsonify(
        transaction_history
    )


# ============================================================
# STATISTICS API
# ============================================================

@app.route('/api/stats')
def stats():

    total = len(
        transaction_history
    )


    fraud_count = sum(

        1

        for transaction in transaction_history

        if transaction['prediction'] == 'FRAUD'

    )


    genuine_count = (
        total - fraud_count
    )


    return jsonify({

        'total_transactions': total,

        'fraud_detected': fraud_count,

        'genuine_transactions': genuine_count

    })


# ============================================================
# HEALTH CHECK
# ============================================================

@app.route('/health')
def health():

    if model is not None and scaler is not None:

        return jsonify({

            'status': 'OK',

            'model_loaded': True,

            'scaler_loaded': True

        })


    return jsonify({

        'status': 'ERROR',

        'model_loaded': False,

        'scaler_loaded': False

    }), 500


# ============================================================
# RUN APPLICATION
# ============================================================

if __name__ == '__main__':

    print()
    print("=" * 60)
    print("FRAUD DETECTION SYSTEM")
    print("=" * 60)

    if model is not None and scaler is not None:

        print("Model Status : READY")

    else:

        print("Model Status : NOT READY")

    print()

    print("Website:")
    print("http://127.0.0.1:5000")

    print()

    print("Health Check:")
    print("http://127.0.0.1:5000/health")

    print("=" * 60)
    print()

    app.run(
        debug=True,
        host='0.0.0.0',
        port=5000
    )