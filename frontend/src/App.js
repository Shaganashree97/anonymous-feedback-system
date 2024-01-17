// frontend/src/App.js
import React, { useState } from 'react';

import './App.css'; // Import the CSS file

// ... (rest of the code remains the same)


function App() {
  const [feedback, setFeedback] = useState('');
  const [submittedFeedback, setSubmittedFeedback] = useState('');

  const handleFeedbackSubmit = () => {
    // In a real application, you would send this feedback data to the backend
    // For simplicity, we'll just update the state here.
    setSubmittedFeedback(feedback);
    setFeedback('');
  };

  return (
    <div className="App">
      <h1>Feedback System</h1>

      <div>
        <h2>Submit Feedback</h2>
        <textarea
          value={feedback}
          onChange={(e) => setFeedback(e.target.value)}
          placeholder="Type your feedback here..."
        />
        <button onClick={handleFeedbackSubmit}>Submit Feedback</button>
      </div>

      {submittedFeedback && (
        <div>
          <h2>Submitted Feedback</h2>
          <p>{submittedFeedback}</p>
        </div>
      )}
    </div>
  );
}

export default App;
