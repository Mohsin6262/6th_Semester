import socket

# Create socket object
client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

# Connect to server at localhost on port 12345
client_socket.connect(('localhost', 12345))

# Send message to server
client_socket.send("Hello Server!".encode())

# Receive response from server
response = client_socket.recv(1024).decode()
print(f"Received from server: {response}")

# Close socket
client_socket.close()
