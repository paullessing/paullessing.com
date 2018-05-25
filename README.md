# paullessing.com
Personal Home Page

Statically hosted on AWS S3.

## Deploy
```
yarn deploy
```

## Setup
Three buckets; `paullessing.com`, `www.paullessing.com`, and `files.paullessing.com`.

## Redirect rules
Go to the main bucket -> Properties -> Static Website Hosting -> Redirect Rules.

Copy in the contents of `notes/bucket-redirect-rules.xml` which redirects `/files` to the `files` bucket.
