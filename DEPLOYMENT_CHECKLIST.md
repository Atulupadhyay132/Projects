# ✅ Deployment Checklist

## Before Local Testing
- [ ] Notebook चलाया है पूरी तरह
- [ ] Models folder में fraud_model.pkl है
- [ ] Models folder में scaler.pkl है  
- [ ] app folder है सभी files के साथ
- [ ] requirements.txt में सभी packages हैं

## Local Testing
- [ ] Command चलाया: `cd app`
- [ ] Command चलाया: `pip install -r requirements.txt`
- [ ] Command चलाया: `python app.py`
- [ ] Browser में http://localhost:5000 खुला
- [ ] Homepage दिख गया
- [ ] "Check Transaction" button काम करता है
- [ ] Results सही दिखते हैं

## Heroku Deployment Prep
- [ ] Heroku account बना लिया: https://www.heroku.com
- [ ] Heroku CLI install किया
- [ ] `heroku login` चलाया
- [ ] Git installed है (`git --version` से check करो)
- [ ] Procfile है app folder में
- [ ] runtime.txt है app folder में

## Heroku Deploy
- [ ] Command चलाया: `heroku create your-app-name`
- [ ] Command चलाया: `git init`
- [ ] Command चलाया: `git add .`
- [ ] Command चलाया: `git commit -m "Initial commit"`
- [ ] Command चलाया: `git push heroku main`
- [ ] Wait किया 2-3 minutes deployment के लिए
- [ ] Command चलाया: `heroku open`
- [ ] Website खुल गई online

## Post-Deployment
- [ ] Homepage load हो गया
- [ ] Transaction check काम करता है
- [ ] Results सही आते हैं
- [ ] कोई error नहीं दिख रहा
- [ ] URL bookmark करो 📌

---

## Troubleshooting

### Problem: Model not loading
```
Solution: Check that models/ folder में both .pkl files हैं
```

### Problem: Port already in use
```
Solution: python app.py --port 5001
```

### Problem: Requirements install error
```
Solution: pip install --upgrade pip
         pip install -r requirements.txt
```

### Problem: Heroku deploy failed
```
Solution: heroku logs --tail
         Check error messages
```

### Problem: Website slow first time
```
Reason: Free Heroku dyno sleeps after 30 min
Solution: Website first access slow होगा, फिर fast हो जाएगा
```

---

## Success! 🎉

Agar सब कुछ check mark है, तो:
- ✅ अपना website ready है
- ✅ Production-ready है
- ✅ दुनिया को दिखा सकते हो!

---

## Keep Notes

**Your Website URL:**
```
https://your-app-name.herokuapp.com
```

**Last Deploy Time:**
```
(जब deploy किया था)
```

**Things that worked well:**
```
(अपने notes)
```

**Future improvements:**
```
(आगे के लिए ideas)
```
