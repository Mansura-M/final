# from deepface import DeepFace
# import cv2

# # Access webcam
# cap = cv2.VideoCapture(0)

# while True:
#     ret, frame = cap.read()
#     if not ret:
#         break

#     # Analyze emotions in the frame
#     try:
#         analysis = DeepFace.analyze(frame, actions=['emotion'], enforce_detection=False)
#         # If analysis is a list, extract the first element
#         if isinstance(analysis, list):
#             analysis = analysis[0]
#         emotion = analysis.get('dominant_emotion', 'Unknown')
#     except Exception as e:
#         emotion = "Detection Error"

#     # Display the emotion on the video feed
#     cv2.putText(frame, f"Emotion: {emotion}", (50, 50), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2, cv2.LINE_AA)
#     cv2.imshow('Emotion Detection', frame)

#     # Break the loop with 'q'
#     if cv2.waitKey(1) & 0xFF == ord('q'):
#         break

# # Release resources
# cap.release()
# cv2.destroyAllWindows()

