<form method="POST" action="/token">
    @CSRF
    
    Search term: <input type="text" name="term" value="" />
    <button type="submit">Go</button>
</form>
