import os
import shutil
import face_recognition
from dotenv import load_dotenv
from Crypto.Cipher import AES
from Crypto.Util.Padding import pad
import base64

def copy_and_encrypt_image(src_path, dest_directory):
    # Ensure the destination directory exists
    os.makedirs(dest_directory, exist_ok=True)
    
    # Get the filename
    filename = os.path.basename(src_path)
    
    # Define the full destination path
    dest_path = os.path.join(dest_directory, filename)
    
    # Copy the file
    shutil.copy(src_path, dest_path)
    print(f"Image copied to {dest_path}")

# Function to add a face to the face recognition model
def add_face(image_path, label):
    try:
        # Load the image using face_recognition library
        image = face_recognition.load_image_file(image_path)

        # Find face locations in the image
        face_locations = face_recognition.face_locations(image)

        if len(face_locations) != 1:
            print(f"Error: Expected exactly one face in '{image_path}', found {len(face_locations)} faces.")
            return

        # Encode the face
        face_encoding = face_recognition.face_encodings(image, face_locations)[0]

        # Add the face encoding to the known_faces list with the label
        known_faces.append((face_encoding, label))
        print(f"Face '{label}' added successfully.")
    except Exception as e:
        print(f"Error adding face '{label}': {e}")

# Function to perform face recognition
def recognize_face(image_path):
    try:
        # Load the image using face_recognition library
        image = face_recognition.load_image_file(image_path)

        # Find face locations in the image
        face_locations = face_recognition.face_locations(image)

        if len(face_locations) != 1:
            print(f"Error: Expected exactly one face in '{image_path}', found {len(face_locations)} faces.")
            return

        # Encode the face
        face_encoding = face_recognition.face_encodings(image, face_locations)[0]

        # Compare the face encoding with known faces
        matches = face_recognition.compare_faces([f[0] for f in known_faces], face_encoding)

        # Find the matching label
        match_index = matches.index(True)
        if match_index != -1:
            match_label = known_faces[match_index][1]
            print(f"Face recognized: '{match_label}'")
            with open("C:\\xampp\\htdocs\\FaceRecognition\\Recognition\\out.txt", "w") as f:
                f.write(match_label)
        else:
            print("Face not recognized.")
    except Exception as e:
        print(f"Error recognizing face: {e}")

# Directory paths
faces_directory = "C:\\xampp\\htdocs\\FaceRecognition\\Faces"
recognition_directory = "C:\\xampp\\htdocs\\FaceRecognition\\Recognition"
backup_directory = "C:\\xampp\\htdocs\\FaceRecognition\\Backup"

# Initialize an empty list to store known faces
known_faces = []

# Infinite loop to continuously monitor the faces directory
while True:
    try:
        # List all files in the faces directory
        for filename in os.listdir(faces_directory):
            # Get the full path of the file
            file_path = os.path.join(faces_directory, filename)

            # Check if the path is a file and has a valid extension
            if os.path.isfile(file_path) and filename.lower().endswith(('.jpg', '.png', '.jpeg')):
                # Extract the label (filename without extension)
                label = os.path.splitext(filename)[0]

                # Copy and encrypt the image before adding to the model
                copy_and_encrypt_image(file_path, backup_directory)

                # Add the face to the face recognition model
                add_face(file_path, label)

                # Delete the processed file
                os.remove(file_path)

        # List all files in the recognition directory
        for filename in os.listdir(recognition_directory):
            # Get the full path of the file
            file_path = os.path.join(recognition_directory, filename)

            # Check if the path is a file and has a valid extension
            if os.path.isfile(file_path) and filename.lower().endswith(('.jpg', '.png', '.jpeg')):
                # Perform face recognition on the image
                recognize_face(file_path)

                # Delete the processed file
                os.remove(file_path)
    except Exception as e:
        print(f"Error: {e}")
