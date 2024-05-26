from cryptography.fernet import Fernet
import os

# Generate a key for encryption
key = Fernet.generate_key()
fernet = Fernet(key)

print(key)

# Open the image file
with open('face.png', 'rb') as file:
    image_data = file.read()

# Encrypt the image data
encrypted_image_data = fernet.encrypt(image_data)

# Save the encrypted image data to a new file
with open('encrypted_face.png', 'wb') as file:
    file.write(encrypted_image_data)

print("Encryption done!")