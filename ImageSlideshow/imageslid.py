import tkinter as tk
from PIL import Image, ImageTk
import os

# ---------------- MAIN WINDOW ----------------

root = tk.Tk()
root.title("Python Image Slideshow")
root.geometry("900x650")
root.configure(bg="white")

# ---------------- IMAGE FOLDER ----------------

folder = "images"

image_files = [
    "image1.png",
    "image2.jpeg",
    "image3.jpeg",
    "image4.jpeg"
]

# ---------------- LOAD IMAGES ----------------

photos = []

for file in image_files:

    path = os.path.join(folder, file)

    img = Image.open(path)

    img = img.resize((800, 500))

    photo = ImageTk.PhotoImage(img)

    photos.append(photo)

# ---------------- LABEL ----------------

image_label = tk.Label(root, bg="white")
image_label.pack(pady=20)

# ---------------- TITLE ----------------

title = tk.Label(
    root,
    text="Python Image Slideshow",
    font=("Arial",20,"bold"),
    bg="white"
)

title.pack()

# ---------------- SLIDESHOW ----------------

current = 0

running = False

def show_image():

    global current

    if running:

        image_label.config(image=photos[current])

        image_label.image = photos[current]

        current = (current + 1) % len(photos)

        root.after(2000, show_image)

# ---------------- PLAY ----------------

def play():

    global running

    if not running:

        running = True

        show_image()

# ---------------- STOP ----------------

def stop():

    global running

    running = False

# ---------------- BUTTONS ----------------

button_frame = tk.Frame(root,bg="white")

button_frame.pack(pady=10)

play_button = tk.Button(
    button_frame,
    text="Play",
    font=("Arial",14),
    bg="green",
    fg="white",
    width=10,
    command=play
)

play_button.grid(row=0,column=0,padx=10)

stop_button = tk.Button(
    button_frame,
    text="Stop",
    font=("Arial",14),
    bg="red",
    fg="white",
    width=10,
    command=stop
)

stop_button.grid(row=0,column=1,padx=10)

# ---------------- FIRST IMAGE ----------------

image_label.config(image=photos[0])
image_label.image = photos[0]

# ---------------- MAIN LOOP ----------------

root.mainloop()