<template>
    <div id="disqus_thread"></div>
</template>

<script>
    export default {
        mounted () {
            var d = document, s = d.createElement('script');
            s.src = 'https://russian-arthouse-dusqus-com.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        }
    }
</script>


