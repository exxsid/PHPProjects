/**
 * Import function triggers from their respective submodules:
 *
 * const {onCall} = require("firebase-functions/v2/https");
 * const {onDocumentWritten} = require("firebase-functions/v2/firestore");
 *
 * See a full list of supported triggers at https://firebase.google.com/docs/functions
 */

const { onRequest } = require("firebase-functions/v2/https");
const logger = require("firebase-functions/logger");

// Create and deploy your first functions
// https://firebase.google.com/docs/functions/get-started

// exports.helloWorld = onRequest((request, response) => {
//   logger.info("Hello logs!", {structuredData: true});
//   response.send("Hello from Firebase!");
// });

const functions = require("firebase-functions");
const admin = require("firebase-admin");
admin.initializeApp();

exports.commentsCounter = functions.firestore
  .document("post_comments/{commentId}")
  .onCreate((snapshot, context) => {
    const postId = snapshot.data().post_id;

    return admin
      .firestore()
      .collection("post_comments")
      .where("post_id", "==", postId)
      .get()
      .then((querySnapshot) => {
        const commentsCount = querySnapshot.size;

        return admin
          .firestore()
          .collection("posts")
          .doc(postId)
          .update({ comment_count: commentsCount });
      })
      .catch((error) => {
        console.error("Error updating comment count: ", error);
      });
  });

exports.likesCounter = functions.firestore
  .document("post_likes/{likeId}")
  .onCreate((snapshot, context) => {
    const postId = snapshot.data().post_id;

    return admin
      .firestore()
      .collection("post_likes")
      .where("post_id", "==", postId)
      .get()
      .then((querySnapshot) => {
        const likeCount = querySnapshot.size;

        return admin
          .firestore()
          .collection("posts")
          .doc(postId)
          .update({ like_count: likeCount });
      })
      .catch((error) => {
        console.error("Error updating like count: ", error);
      });
  });

exports.unlikeListener = functions.firestore
  .document("post_likes/{likeId}")
  .onDelete((snapshot, context) => {
    const postId = snapshot.data().post_id;

    return admin
      .firestore()
      .collection("post_likes")
      .where("post_id", "==", postId)
      .get()
      .then((querySnapshot) => {
        const likeCount = querySnapshot.size;

        return admin
          .firestore()
          .collection("posts")
          .doc(postId)
          .update({ like_count: likeCount });
      })
      .catch((error) => {
        console.error("Error updating like count: ", error);
      });
  });
