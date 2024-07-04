document.addEventListener('DOMContentLoaded', function() {
    // Variables to store the current annotation mode state.
    let isHighlighting = false;
    let isAddingNote = false;

    // Select the buttons and add click event listeners.
    const highlightBtn = document.getElementById('highlight-btn');
    const noteBtn = document.getElementById('note-btn');

    highlightBtn.addEventListener('click', () => {
        isHighlighting = !isHighlighting;
        isAddingNote = false;
        highlightBtn.classList.toggle('active', isHighlighting);
        noteBtn.classList.remove('active');
    });

    noteBtn.addEventListener('click', () => {
        isAddingNote = !isAddingNote;
        isHighlighting = false;
        noteBtn.classList.toggle('active', isAddingNote);
        highlightBtn.classList.remove('active');
    });

    // Function to highlight selected text.
    function highlightText() {
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            const span = document.createElement('span');
            span.style.backgroundColor = 'yellow';
            range.surroundContents(span);
            selection.removeAllRanges();
        }
    }

    // Function to add a note.
    function addNote() {
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            const span = document.createElement('span');
            span.style.backgroundColor = 'lightblue';
            span.title = prompt('Enter your note:');
            range.surroundContents(span);
            selection.removeAllRanges();
        }
    }

    // Handle text selection events.
    document.addEventListener('mouseup', () => {
        if (isHighlighting) {
            highlightText();
        } else if (isAddingNote) {
            addNote();
        }
    });
});
