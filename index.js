var searchInput = document.querySelector('#searchInput');
var autocomplete = document.querySelector('#autocomplete');

searchInput.addEventListener('focusin', event => {
  autocomplete.style.display = 'block';
  if (autocomplete.textContent.length == 0 || event.target.value.length == 0) {
    autocomplete.innerHTML = 'Nothing here';
  }
})


searchInput.addEventListener('focusout', event => {
  setTimeout(() => {
    autocomplete.style.display = 'none';
  }, 100);
})

searchInput.addEventListener('input', _.throttle(async event => {
  try {

    if (event.target.value.length === 0) {
        autocomplete.style.display = 'block';
        autocomplete.innerHTML = '<div id="notfound">Book not found</div>';
        return;
    }

    if (event.target.value.length >= 4) {

      const { data } = await axios.get('/books.php', {
        params: {
          book:event.target.value
        }
      })

      if (!data.length) {
        autocomplete.style.display = 'block';
        autocomplete.innerHTML = '<div id="notfound">Book not found</div>';
        return;
      }

      autocomplete.style.display = 'block';
      var booksFound = '<ul>';
      booksFound += data.map(book => {
        return `
        <li class="bookLi"><a href="/book/${book.id}">${book.title}</a></li>
        `
      }).join('');
      booksFound += '</ul>';

      autocomplete.innerHTML = booksFound;
    }
  } catch (error) {
    console.log(error)
  }

}, 500))