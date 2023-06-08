<script>
    
    fetch(`http://192.168.0.12/relay/0/?turn=on`)
        .then((res) => {
            return res.json()
        })
        .then((data) => {
            console.log(data);
        })
        .catch((err) => {
            console.log(err);
        })

</script>