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
const {
  onDocumentCreated,
  onDocumentDeleted,
} = require("firebase-functions/v2/firestore");

// Create and deploy your first functions
// https://firebase.google.com/docs/functions/get-started

// exports.helloWorld = onRequest((request, response) => {
//   logger.info("Hello logs!", {structuredData: true});
//   response.send("Hello from Firebase!");
// });

const { initializeApp } = require("firebase-admin/app");
const admin = require("firebase-admin");
initializeApp();

exports.countComments = onDocumentCreated(
  "post_comments/{commentId}",
  (event) => {
    const snapshot = event.data;
    const postId = snapshot.data().postId;

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
  }
);

exports.countLikes = onDocumentCreated("post_likes/{likeId}", (event) => {
  const snapshot = event.data;
  const postId = snapshot.data().postId;

  return admin
    .firestore()
    .collection("post_likes")
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
      console.error("Error updating like count: ", error);
    });
});

exports.unlikeCount = onDocumentDeleted("post_likes/{likeId}", (event) => {
  const snapshot = event.data;
  const postId = snapshot.data().postId;

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
