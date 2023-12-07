@section('meta_tags')
    <?php $metaData = getMetaData(isset($meta) ? $meta : []) ?>
    <meta property="op:markup_version" content="v1.0">
    <meta property="fb:article_style" content="myarticlestyle">
    <meta name="description" content="<?= $metaData['description']; ?>">
    <meta property="article:content_tier" content="free">
    <meta property="og:title" content="<?= $metaData['title']; ?>">
    <meta property="og:description" content="<?= $metaData['description']; ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?= $metaData['url']; ?>">
    <meta name="twitter:card" content="summary_large_image">
    {{--    <meta name="twitter:site" content="@tweetsNV">--}}
    <meta name="twitter:title" content="<?= $metaData['title']; ?>">
    <meta name="twitter:description" content="<?= $metaData['description']; ?>">
    <meta property="og:image" content="<?= $metaData['image']; ?>">
    <meta name="twitter:image" content="<?= $metaData['image']; ?>">
    <meta property="og:image:width" content="1920">
    <meta property="og:image:height" content="960">
    <meta name="robots" content="max-image-preview:large">
@endsection
