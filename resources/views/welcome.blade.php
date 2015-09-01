<!DOCTYPE html>
<html>
<head>
    <title>Laravel Homepage</title>
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            padding-top: 2em;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body>
<div id="sites" class="container">

    <form method="POST" v-on="submit: onSubmitForm">

        <div class="form-group">
            <label for="title">
                Title:
                <span class="error" v-if="! newSite.title">*</span>
            </label>
            <input type="text" name="title" id="title" class="form-control" v-on="keyup: changeEvent" v-model="newSite.title" autocomplete="off" autofocus>
        </div>

        <div class="form-group">
            <label for="url">
                URL:
                <span class="error" v-if="! newSite.url">*</span>
            </label>
            <input type="text" name="url" id="url" class="form-control" v-model="newSite.url">
        </div>

        <div class="form-group" v-if="! submitted">
            <button type="submit" class="btn btn-default" v-attr="disabled: errors">Add Site</button>
        </div>

        <div class="alert alert-success animated fadeIn" v-if="submitted">Thanks!</div>

    </form>

    <div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <a href="@{{ newSite.url }}">
            <div class="card" id="new-site" style="background-image: @{{ newSite.background_image }}">
                <div class="card-block">
                    <h4 class="card-title" style="color: @{{ newSite.color }}">@{{ newSite.title }}</h4>

                    <p class="card-text">@{{ newSite.url }}</p>
                </div>
            </div>
        </a>
    </div>
    </div>

    <hr/>

    <div class="card-columns">
        <a href="@{{ url }}" v-repeat="sites">
            <div class="card" style="background-image: @{{ background_image }}">
                <div class="card-block">
                    <h4 class="card-title" style="color: @{{ color }}">@{{ title }}</h4>

                    <p class="card-text">@{{ url }}</p>
                </div>
            </div>
        </a>
    </div>

    <pre>@{{ $data | json }}</pre>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.12/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.15/vue-resource.min.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/geopattern.min.js"></script>

<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

    new Vue({
        el: '#sites',

        data: {
            newSite: {
                title: '',
                url: ''
            },

            submitted: false
        },

        computed: {
            errors: function () {
                for (var key in this.newSite) {
                    if (!this.newSite[key]) return true;
                }

                return false;
            }
        },

        ready: function () {
            this.fetchSites();
        },

        methods: {
            fetchSites: function () {
                this.$http.get('sites', function (sites) {
                    this.$set('sites', sites);
                })
            },

            onSubmitForm: function (e) {
                e.preventDefault();

                var site = this.newSite;

                this.sites.push(site);

                this.newSite = {title: '', url: ''};

                this.submitted = true;

                this.$http.post('sites', site);
            },

            changeEvent: function() {
                var pattern = GeoPattern.generate(this.newSite.title);
                $("#new-site").css('background-image', pattern.toDataUrl());
            }
        }
    });
</script>
</body>
</html>
