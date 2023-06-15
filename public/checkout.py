import cv2
import face_recognition
import mysql.connector
import mysql.connector
from datetime import date, datetime

reference_images = []

def fetch_images():
    cnx = mysql.connector.connect(
        host='localhost',
        user='root',
        password='',
        database='face_att'
    )

    cursor = cnx.cursor()

    query = "SELECT * FROM employees"
    cursor.execute(query)

    results = cursor.fetchall()

    for row in results:
        image_path = row[8]
        label = row[0]
        print(image_path)
        reference_images.append(('images/known_faces/'+image_path, label))

    cursor.close()
    cnx.close()


def checkout(employee_id):
    cnx = mysql.connector.connect(
        host='localhost',
        user='root',
        password='',
        database='face_att'
    )

    cursor = cnx.cursor()

    today = date.today()

    query = "SELECT COUNT(*) FROM attendances WHERE employee_id = %s AND date = %s AND time_out IS NULL"
    values = (employee_id, today)
    cursor.execute(query, values)

    result = cursor.fetchone()
    count = result[0]

    if count > 0:
        update_time(employee_id)

    cursor.close()
    cnx.close()


def update_time(employee_id):
    cnx = mysql.connector.connect(
        host='localhost',
        user='root',
        password='',
        database='face_att'
    )

    cursor = cnx.cursor()

    today = date.today()
    current_time = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

    query = "UPDATE attendances SET time_out = %s WHERE employee_id = %s AND date = %s AND time_out IS NULL"
    values = (current_time, employee_id, today)
    cursor.execute(query, values)

    cnx.commit()

    cursor.close()
    cnx.close()


'''

# # Load the reference images and labels
# reference_images = [
#     ('images/known_faces/fatso.jpg', 'Faraimunashe'),
#     ('images/known_faces/1685542663.jpg', 'Biden'),
#     ('images/known_faces/putin.jpg', 'Putin')
# ]

'''

fetch_images()

reference_encodings = []
labels = []

for image_path, label in reference_images:
    reference_image = face_recognition.load_image_file(image_path)
    reference_encoding = face_recognition.face_encodings(reference_image)[0]
    reference_encodings.append(reference_encoding)
    labels.append(label)

# Initialize the webcam or capture device
cap = cv2.VideoCapture(0)

# Main loop
while True:
    # Read frame from the webcam
    ret, frame = cap.read()

    rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)

    face_locations = face_recognition.face_locations(rgb_frame)
    face_encodings = face_recognition.face_encodings(rgb_frame, face_locations)

    # Iterate over detected faces
    for (top, right, bottom, left), face_encoding in zip(face_locations, face_encodings):
        # Compare the face encoding with the reference encodings
        matches = face_recognition.compare_faces(reference_encodings, face_encoding)

        for i, match in enumerate(matches):
            if match:
                label = labels[i]
                checkout(label)

                print(f"Face recognized: {label}")
                break

        cv2.rectangle(frame, (left, top), (right, bottom), (0, 255, 0), 2)

    cv2.imshow('Face Login', frame)

    if cv2.waitKey(1) & 0xFF == ord('q'):
        break


cap.release()
cv2.destroyAllWindows()
