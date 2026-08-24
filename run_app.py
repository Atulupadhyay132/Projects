#!/usr/bin/env python3
"""
🔐 Fraud Detection System - App Runner
Simply run this after the notebook completes!
"""

import os
import sys
import subprocess
from pathlib import Path

def main():
    print("\n" + "="*70)
    print("🚀 FRAUD DETECTION SYSTEM - APP LAUNCHER")
    print("="*70)
    
    # Check if we're in the right directory
    if not os.path.exists('app/app.py'):
        print("\n❌ ERROR: app/app.py not found!")
        print("Make sure you:")
        print("1. Ran the Jupyter notebook completely")
        print("2. Are in the correct folder")
        print("3. The 'app' folder exists with app.py inside")
        sys.exit(1)
    
    # Check if models exist
    if not os.path.exists('models/fraud_model.pkl'):
        print("\n❌ ERROR: Model files not found!")
        print("Please run the notebook first to train the model.")
        sys.exit(1)
    
    print("\n✅ All files found! Starting web app...\n")
    
    # Change to app directory
    os.chdir('app')
    
    # Check Python packages
    print("📦 Checking packages...")
    try:
        import flask
        import sklearn
        print("✓ Required packages installed")
    except ImportError:
        print("📥 Installing packages...")
        subprocess.check_call([sys.executable, "-m", "pip", "install", "-r", "requirements.txt"])
    
    # Start Flask app
    print("\n" + "="*70)
    print("🌐 Starting Web Server...")
    print("="*70)
    print("\n📌 Open your browser at: http://localhost:5000")
    print("📌 Press Ctrl+C to stop the server\n")
    
    # Run app
    os.system(f"{sys.executable} app.py")

if __name__ == "__main__":
    main()
