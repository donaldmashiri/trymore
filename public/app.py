import cv2
import face_recognition

# Load the reference image and label
reference_image = face_recognition.load_image_file('images/known_faces/me.jpg')
reference_encoding = face_recognition.face_encodings(reference_image)[0]
label = "Faraimunashe"

# Initialize the webcam or capture device
cap = cv2.VideoCapture(0)

# Main loop
while True:
    # Read frame from the webcam
    ret, frame = cap.read()

    # Convert the frame from BGR to RGB (required by face_recognition)
    rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)

    # Find all the faces and their encodings in the current frame
    face_locations = face_recognition.face_locations(rgb_frame)
    face_encodings = face_recognition.face_encodings(rgb_frame, face_locations)

    # Iterate over detected faces
    for (top, right, bottom, left), face_encoding in zip(face_locations, face_encodings):
        # Compare the face encoding with the reference encoding
        matches = face_recognition.compare_faces([reference_encoding], face_encoding)
        if matches[0]:
            # Face recognized, perform login or other actions
            print("Face recognized, login successful!")

        # Draw a rectangle around the face
        cv2.rectangle(frame, (left, top), (right, bottom), (0, 255, 0), 2)

    # Display the frame
    cv2.imshow('Face Login', frame)

    # Exit loop on 'q' key press
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release the capture device and close windows
cap.release()
cv2.destroyAllWindows()
