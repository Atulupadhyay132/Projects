# 🔐 Fraud Detection System - Quick Start Guide

## ⚡ 5 MINUTE SETUP

### Step 1: Download Everything
```
fraud_detection_complete.ipynb  ← Download यह file
(अपने Computer में कहीं रखो)
```

### Step 2: Open Jupyter & Run
```bash
# Terminal/CMD खोलो और यह command चलाओ:
jupyter notebook

# फिर fraud_detection_complete.ipynb खोलो
# और सभी cells को चलाओ (Top से Bottom तक)
# Shift + Enter से हर cell चलाओ
```

### Step 3: Download Dataset
```
1. जाओ: https://www.kaggle.com/datasets/mlg-ulb/creditcardfraud
2. Download करो: creditcard.csv
3. Apne notebook के पास एक 'data' folder में रखो
   (या notebook automatically बनाएगा)
```

### Step 4: Run Notebook
- सभी cells को चलाओ (कुछ 3-5 minutes लगेगा)
- Last cell को run करने के बाद:
  ```
  cd app
  python app.py
  ```
- Browser में खोलो: http://localhost:5000

### Step 5: Deploy (Heroku)
```bash
# Heroku account बनाओ: https://www.heroku.com
# फिर यह commands चलाओ:

heroku login
cd app
heroku create fraud-detector-app-yourname
git init
git add .
git commit -m "Fraud detection app"
git push heroku main
heroku open
```

---

## 📂 Files बनेंगी:
```
folder/
├── data/
│   └── creditcard.csv
├── models/
│   ├── fraud_model.pkl
│   └── scaler.pkl
└── app/
    ├── app.py
    ├── requirements.txt
    ├── Procfile
    ├── runtime.txt
    └── templates/
        ├── index.html
        └── predict.html
```

---

## 🎯 यह सब जानना जरूरी है:

| कदम | समय | कहाँ चलाएं |
|-----|------|----------|
| Dataset Download | 2 min | Browser + Kaggle |
| Notebook Run | 5 min | Jupyter |
| Local Test | 2 min | http://localhost:5000 |
| Heroku Deploy | 3 min | Terminal |
| **Total** | **~15 min** | |

---

## ⚠️ Problem हो तो:

**Model loading में error:**
- Check करो कि models folder में दोनों .pkl files हैं

**Port already in use:**
```bash
python app.py --port 5001
```

**Heroku deploy fail:**
```bash
heroku logs --tail
```

---

## ✅ Success होने के बाद:

1. **Local**: http://localhost:5000 पर website
2. **Live**: https://fraud-detector-app-yourname.herokuapp.com

---

**Questions?** Notebook के last cell को देखो - सभी instructions वहाँ हैं! 🚀
