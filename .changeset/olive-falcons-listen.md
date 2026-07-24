---
"@henrotaym/laravel-trustup-media-io": minor
---

Add MediaEndpoint::search (POST payload lookup) and use it to load external media relations, preventing HTTP 414 failures that silently dropped media on large uuid batches. Requires trustup-io-media with the POST /media/search route.
