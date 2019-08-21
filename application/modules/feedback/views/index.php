<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Scale</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />

</head>
 

 
<body>
    <style>
        #pointer {
            position: absolute;
            transition: 0.5s;
            top: 308px;
            left: 522px;
            transition-timing-function: ease-in-out;
            transform-origin: 50% 93%;
            /* animation: spin 3s linear infinite; */
        }
        
        .on {
            fill: pink;
            stroke: red;
            stroke-width: 2;
        }
        
        #status img {
            transition: 0.5s;
            transition-timing-function: ease-in-out;
        }
        
        .btn.btn-success {
            padding: 10px 27px;
            font-size: 25px;
            width:100%;
        }
        /* WebKit and Opera browsers */
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="mt-5">How Likely are you to recommend us in sharing therapy related scientific information on daily basic</h4>
                <svg class="us" width="90%" height="50%" viewBox="0 0 320 159" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path  data-set="vector" data-pointer="1" data-deg="-90deg" fill-rule="evenodd" clip-rule="evenodd" d="M0 158.735L63.8722 158.754C63.9461 152.746 64.5743 144.391 65.96 138.587C66.311 137.182 67.3827 133.559 67.2533 132.357L7.29809 112.911C6.22648 115.203 4.97009 120.656 4.36038 123.244C1.64438 134.908 0.129333 146.461 0 158.735Z" fill="#513737"/>
                    <path d="M33.0601 147H30.9434V138.841L28.4165 139.625V137.903L32.833 136.321H33.0601V147Z" fill="white"/>
                    <path  data-set="vector"  data-pointer="2" data-deg="-71deg" fill-rule="evenodd" clip-rule="evenodd" d="M8.04306 109.325C9.74287 110.194 13.2718 111.1 15.3781 111.784C17.9833 112.615 20.496 113.447 22.9903 114.261L66.1507 128.328C69.6242 129.492 67.6472 127.921 73.264 116.22C74.1878 114.316 75.3333 112.283 76.3126 110.601C76.9223 109.51 79.472 105.776 79.5829 104.833C78.8623 103.946 74.2432 100.878 73.1162 100.046C71.8044 99.0661 66.2246 95.48 66.2246 95.48L66.2556 95.5L65.3806 95C65.1774 94.7597 64.6931 94.5 64.6931 94.5L33.9097 71.5606C32.6903 70.6733 30.3438 68.64 28.8103 68.1594C28.2375 69.3979 26.6486 71.4497 25.8172 72.7067C22.6577 77.5127 19.8678 82.2264 17.2257 87.4206C15.064 91.6721 8.57887 105.443 8.04306 109.325Z" fill="#784E48"/>
                    <path d="M46.228 105H38.9185V103.55L42.3682 99.873C42.8418 99.3555 43.1909 98.9038 43.4155 98.5181C43.645 98.1323 43.7598 97.7661 43.7598 97.4194C43.7598 96.9458 43.6401 96.5747 43.4009 96.3062C43.1616 96.0327 42.8198 95.896 42.3755 95.896C41.897 95.896 41.5186 96.062 41.2402 96.394C40.9668 96.7212 40.8301 97.1533 40.8301 97.6904H38.7061C38.7061 97.041 38.8599 96.4478 39.1675 95.9106C39.48 95.3735 39.9194 94.9536 40.4858 94.6509C41.0522 94.3433 41.6943 94.1895 42.4121 94.1895C43.5107 94.1895 44.3628 94.4531 44.9683 94.9805C45.5786 95.5078 45.8838 96.2524 45.8838 97.2144C45.8838 97.7417 45.7471 98.2788 45.4736 98.8257C45.2002 99.3726 44.7314 100.01 44.0674 100.737L41.6431 103.293H46.228V105Z" fill="white"/>
                    <path data-set="vector"  data-pointer="3" data-deg="-52deg" fill-rule="evenodd" clip-rule="evenodd" d="M31.853 64.9615L76.0295 97.273C77.4337 98.3451 80.9627 101.099 82.5516 101.857C86.0806 95.2767 100.917 82.7809 101.009 82.6515C100.677 81.8012 99.3465 80.23 98.8291 79.5091C98.0162 78.3815 97.388 77.4942 96.5935 76.4036L82.9027 57.5491C79.7432 53.1867 76.8979 49.3603 73.8124 45.0164L64.5373 32.3727C63.5396 32.65 63.1147 33.2045 62.1724 33.9439C53.7288 40.4506 46.1166 47.6782 39.0587 55.7561C37.6175 57.4012 32.592 63.2609 31.853 64.9615Z" fill="#99504B"/>
                    <path d="M67.0718 65.7305H68.1997C68.7368 65.7305 69.1348 65.5962 69.3936 65.3276C69.6523 65.0591 69.7817 64.7026 69.7817 64.2583C69.7817 63.8286 69.6523 63.4941 69.3936 63.2549C69.1396 63.0156 68.7881 62.896 68.3389 62.896C67.9336 62.896 67.5942 63.0083 67.3208 63.2329C67.0474 63.4526 66.9106 63.7407 66.9106 64.0972H64.7939C64.7939 63.5405 64.9429 63.0425 65.2407 62.603C65.5435 62.1587 65.9634 61.812 66.5005 61.563C67.0425 61.314 67.6382 61.1895 68.2876 61.1895C69.4155 61.1895 70.2993 61.4604 70.939 62.0024C71.5786 62.5396 71.8984 63.2817 71.8984 64.229C71.8984 64.7173 71.7495 65.1665 71.4517 65.5767C71.1538 65.9868 70.7632 66.3018 70.2798 66.5215C70.8804 66.7363 71.3271 67.0586 71.6201 67.4883C71.918 67.918 72.0669 68.4258 72.0669 69.0117C72.0669 69.959 71.7202 70.7183 71.0269 71.2896C70.3384 71.8608 69.4253 72.1465 68.2876 72.1465C67.2231 72.1465 66.3516 71.8657 65.6729 71.3042C64.999 70.7427 64.6621 70.0005 64.6621 69.0776H66.7788C66.7788 69.478 66.9277 69.8052 67.2256 70.0591C67.5283 70.313 67.8994 70.4399 68.3389 70.4399C68.8418 70.4399 69.2349 70.3081 69.5181 70.0444C69.8062 69.7759 69.9502 69.4219 69.9502 68.9824C69.9502 67.918 69.3643 67.3857 68.1924 67.3857H67.0718V65.7305Z" fill="white"/>
                    <path data-set="vector"  data-pointer="4" data-deg="-31deg" fill-rule="evenodd" clip-rule="evenodd" d="M67.475 30.0806C70.4682 33.6852 82.4962 50.7652 85.7665 55.2385C88.7227 59.2497 91.9929 63.6861 94.8752 67.7527C96.4272 69.9339 97.8499 71.8564 99.4758 74.1115C100.566 75.6273 102.857 79.0839 104.113 80.3409L109.582 76.8473C111.744 75.5349 113.093 74.7215 115.291 73.5755C121.352 70.4515 122.83 70.3221 127.874 68.0485L108.862 9.06334C106.682 9.26667 99.8084 12.2058 97.5543 13.1855C93.9884 14.7197 90.367 16.3649 86.875 18.1949C81.1659 21.1709 77.1935 23.463 72.0202 26.9012C70.579 27.8624 68.9347 28.8421 67.475 30.0806Z" fill="#B93E42"/>
                    <path  d="M103.181 41.9863H104.389V43.6929H103.181V46H101.064V43.6929H96.6914L96.5962 42.3599L101.042 35.3359H103.181V41.9863ZM98.7056 41.9863H101.064V38.2217L100.925 38.4634L98.7056 41.9863Z" fill="white"/>
                    <path data-set="vector"   data-pointer="5" data-deg="-11deg" fill-rule="evenodd" clip-rule="evenodd" d="M112.465 7.93576L131.495 66.847C146.073 62.8173 144.41 63.9818 158.156 62.5585C158.71 52.78 158.212 41.4858 158.212 31.5409C158.212 27.807 158.563 3.57334 158.101 0.560307C154.424 0.283034 149.713 0.966974 145.962 1.17031C139.237 1.52152 115.606 5.5697 112.465 7.93576Z" fill="#CA7C43"/>
                    <path d="M136.233 26.7559L136.849 21.3359H142.825V23.1011H138.584L138.321 25.3936C138.824 25.125 139.358 24.9907 139.925 24.9907C140.94 24.9907 141.736 25.3057 142.312 25.9355C142.889 26.5654 143.177 27.4468 143.177 28.5796C143.177 29.2681 143.03 29.8857 142.737 30.4326C142.449 30.9746 142.034 31.397 141.492 31.6997C140.95 31.9976 140.311 32.1465 139.573 32.1465C138.929 32.1465 138.331 32.0171 137.779 31.7583C137.227 31.4946 136.79 31.126 136.468 30.6523C136.15 30.1787 135.982 29.6392 135.962 29.0337H138.057C138.101 29.478 138.255 29.8247 138.519 30.0737C138.787 30.3179 139.136 30.4399 139.566 30.4399C140.044 30.4399 140.413 30.269 140.672 29.9272C140.931 29.5806 141.06 29.0923 141.06 28.4624C141.06 27.8569 140.911 27.3931 140.613 27.0708C140.315 26.7485 139.893 26.5874 139.346 26.5874C138.843 26.5874 138.436 26.7192 138.123 26.9829L137.918 27.1733L136.233 26.7559Z" fill="white"/>
                    <path data-set="vector"   data-pointer="6" data-deg="9deg" fill-rule="evenodd" clip-rule="evenodd" d="M161.822 8.99998C161.822 8.99998 161.91 11.3898 161.915 12.9218C161.915 13.1371 161.915 13.473 161.915 13.473C161.915 13.473 161.832 13.9424 161.822 14.2465C161.819 14.3623 161.822 14.5433 161.822 14.5433C161.822 15.4027 161.822 14.7777 161.822 14.7777C161.822 14.7777 161.822 5.3615 161.822 18.8C161.822 32.2385 161.471 49.5588 161.952 62.5536C171.393 62.6091 180.576 64.2727 188.299 66.7127C189.149 65.6221 202.304 23.8648 205.131 15.4727C205.833 13.4209 207.237 9.61302 207.477 7.83847C204.854 5.93453 186.377 2.42241 182.109 1.96029C175.088 1.18392 171.098 0.795742 164.132 0.499985C160.695 0.352106 162.063 0.204227 161.693 5.87908L161.822 8.99998Z" fill="#E2BA16"/>
                    <path d="M179.661 21.2261V22.9692H179.456C178.499 22.9839 177.727 23.2329 177.141 23.7163C176.56 24.1997 176.211 24.8711 176.094 25.7305C176.66 25.1543 177.375 24.8662 178.24 24.8662C179.167 24.8662 179.905 25.1982 180.452 25.8623C180.999 26.5264 181.272 27.4004 181.272 28.4844C181.272 29.1777 181.121 29.8052 180.818 30.3667C180.52 30.9282 180.095 31.3652 179.543 31.6777C178.997 31.9902 178.376 32.1465 177.683 32.1465C176.56 32.1465 175.652 31.7559 174.958 30.9746C174.27 30.1934 173.926 29.1509 173.926 27.8472V27.0854C173.926 25.9282 174.143 24.9077 174.578 24.0239C175.017 23.1353 175.645 22.4492 176.46 21.9658C177.28 21.4775 178.23 21.231 179.309 21.2261H179.661ZM177.595 26.5654C177.253 26.5654 176.943 26.6558 176.665 26.8364C176.387 27.0122 176.182 27.2466 176.05 27.5396V28.1841C176.05 28.8921 176.189 29.4463 176.467 29.8467C176.746 30.2422 177.136 30.4399 177.639 30.4399C178.093 30.4399 178.459 30.2617 178.738 29.9053C179.021 29.5439 179.163 29.0776 179.163 28.5063C179.163 27.9253 179.021 27.4565 178.738 27.1001C178.455 26.7437 178.074 26.5654 177.595 26.5654Z" fill="white"/>
                    <path data-set="vector"  data-pointer="7" data-deg="28deg" fill-rule="evenodd" clip-rule="evenodd" d="M192.005 68.0115C200.559 71.8009 201.058 71.1909 210.222 76.7363L214.324 79.3982C214.509 79.5276 214.915 79.8418 214.952 79.8788C215.599 80.3039 215.358 80.1376 215.857 80.3594C216.763 79.6015 219.423 75.7197 220.421 74.2963C221.991 72.0412 223.47 70.1927 225.022 67.9376C231.932 57.9557 240.763 46.4027 247.95 36.3654C248.819 35.1454 249.41 34.2951 250.168 33.297C250.907 32.3173 251.794 30.8939 252.477 30.1361C251.553 29.1564 245.622 25.6073 245.622 25.6073L240.911 22.5203L239.581 21.8179C239.581 21.8179 235.701 19.5627 233.28 18.2688C230.176 16.6421 214.509 9.22969 211.127 9.1003L192.005 68.0115Z" fill="#C4DD7C"/>
                    <path d="M221.169 35.5225L217.046 45H214.812L218.943 36.0498H213.64V34.3359H221.169V35.5225Z" fill="white"/>
                    <path data-set="vector"  data-pointer="8" data-deg="50deg" fill-rule="evenodd" clip-rule="evenodd" d="M218.98 82.6515L228.809 91.5982C230.823 93.7055 236.273 99.5836 237.419 101.876L240.708 99.6576C241.872 98.8258 242.925 98.0679 243.96 97.2915C246.01 95.7758 248.56 93.8533 250.352 92.7073L263.027 83.4649C267.313 80.267 271.304 77.4758 275.683 74.2409L285.106 67.383C286.122 66.6436 287.397 65.8673 288.265 64.9615C287.175 63.3903 285.845 61.7452 284.737 60.3588C275.849 49.4342 267.757 41.6336 256.856 33.1861C256.228 32.7055 256.154 32.5576 255.433 32.4097C254.657 33.297 253.955 34.3506 253.161 35.4412L246.306 44.8685C243.202 49.157 240.375 53.0758 237.216 57.4012C234.26 61.4864 231.063 65.7933 228.125 69.9339C226.647 72.0227 225.021 74.2224 223.525 76.2742C222.564 77.6052 219.497 81.45 218.98 82.6515Z" fill="#66A45D"/>
                    <path d="M256.869 63.1704C256.869 63.688 256.74 64.147 256.481 64.5474C256.222 64.9478 255.866 65.2676 255.412 65.5068C255.929 65.7559 256.339 66.1001 256.642 66.5396C256.945 66.9741 257.096 67.4868 257.096 68.0776C257.096 69.0249 256.774 69.7744 256.129 70.3262C255.485 70.873 254.608 71.1465 253.5 71.1465C252.392 71.1465 251.513 70.8706 250.863 70.3188C250.214 69.7671 249.889 69.02 249.889 68.0776C249.889 67.4868 250.041 66.9717 250.343 66.5322C250.646 66.0928 251.054 65.751 251.566 65.5068C251.112 65.2676 250.756 64.9478 250.497 64.5474C250.243 64.147 250.116 63.688 250.116 63.1704C250.116 62.2622 250.419 61.5396 251.024 61.0024C251.63 60.4604 252.453 60.1895 253.493 60.1895C254.528 60.1895 255.348 60.458 255.954 60.9951C256.564 61.5273 256.869 62.2524 256.869 63.1704ZM254.972 67.9238C254.972 67.46 254.838 67.0889 254.569 66.8105C254.301 66.5322 253.939 66.3931 253.485 66.3931C253.036 66.3931 252.677 66.5322 252.409 66.8105C252.14 67.084 252.006 67.4551 252.006 67.9238C252.006 68.3779 252.138 68.7441 252.401 69.0225C252.665 69.3008 253.031 69.4399 253.5 69.4399C253.959 69.4399 254.318 69.3057 254.577 69.0371C254.84 68.7686 254.972 68.3975 254.972 67.9238ZM254.752 63.2729C254.752 62.8579 254.643 62.5259 254.423 62.2769C254.203 62.0229 253.893 61.896 253.493 61.896C253.097 61.896 252.79 62.0181 252.57 62.2622C252.35 62.5063 252.24 62.8433 252.24 63.2729C252.24 63.6978 252.35 64.0396 252.57 64.2983C252.79 64.5571 253.1 64.6865 253.5 64.6865C253.9 64.6865 254.208 64.5571 254.423 64.2983C254.643 64.0396 254.752 63.6978 254.752 63.2729Z" fill="white"/>
                    <path data-set="vector"   data-pointer="9" data-deg="70deg" fill-rule="evenodd" clip-rule="evenodd" d="M254.193 94.5C254.193 94.5 252.2 95.7203 250.482 97.0697L239.969 104.833C240.043 105.48 244.883 113.447 246.177 116.091C247.267 118.29 247.895 119.769 248.856 122.043C249.318 123.133 250.87 127.847 251.332 128.512L255.008 127.755C256.45 127.292 257.466 126.978 258.888 126.535C261.512 125.666 263.84 124.908 266.519 124.058L311.509 109.325C310.659 103.41 300.589 83.6867 296.783 77.5312C295.619 75.6458 291.813 69.4903 290.52 68.1779C289.393 68.603 273.725 80.2485 272.284 81.2652L255.175 93.6685C254.251 94.6482 254.193 94.5 254.193 94.5Z" fill="#38803F"/>
                    <path d="M277.87 102.737C277.318 103.279 276.673 103.55 275.936 103.55C274.994 103.55 274.239 103.228 273.673 102.583C273.106 101.934 272.823 101.06 272.823 99.9614C272.823 99.2632 272.975 98.6235 273.277 98.0425C273.585 97.4565 274.012 97.0024 274.559 96.6802C275.106 96.353 275.721 96.1895 276.405 96.1895C277.108 96.1895 277.733 96.3652 278.28 96.7168C278.827 97.0684 279.251 97.5737 279.554 98.2329C279.857 98.8921 280.011 99.6465 280.016 100.496V101.28C280.016 103.057 279.574 104.454 278.69 105.469C277.806 106.485 276.554 107.027 274.933 107.095L274.413 107.103V105.337L274.881 105.33C276.722 105.247 277.718 104.383 277.87 102.737ZM276.456 101.932C276.798 101.932 277.091 101.844 277.335 101.668C277.584 101.492 277.772 101.28 277.899 101.031V100.159C277.899 99.4414 277.762 98.8848 277.489 98.4893C277.215 98.0938 276.849 97.896 276.39 97.896C275.965 97.896 275.616 98.0913 275.343 98.4819C275.069 98.8677 274.933 99.3535 274.933 99.9395C274.933 100.521 275.064 100.999 275.328 101.375C275.597 101.746 275.973 101.932 276.456 101.932Z" fill="white"/>
                    <path  data-set="vector"  data-pointer="10" data-deg="93deg" fill-rule="evenodd" clip-rule="evenodd" d="M252.754 132.394C252.606 133.263 254.842 142.339 255.119 144.724C255.674 149.585 256.043 153.522 256.098 158.661L319.971 158.772C319.786 141.785 316.978 127.329 312.765 112.93L252.754 132.394Z" fill="#2F6131"/>
                    <path d="M284.253 147H282.137V138.841L279.61 139.625V137.903L284.026 136.321H284.253V147ZM294.903 142.591C294.903 144.065 294.598 145.193 293.987 145.975C293.377 146.756 292.483 147.146 291.307 147.146C290.145 147.146 289.256 146.763 288.641 145.997C288.025 145.23 287.71 144.131 287.696 142.701V140.738C287.696 139.249 288.003 138.118 288.619 137.347C289.239 136.575 290.13 136.189 291.292 136.189C292.454 136.189 293.343 136.573 293.958 137.339C294.573 138.101 294.888 139.197 294.903 140.628V142.591ZM292.786 140.438C292.786 139.554 292.664 138.912 292.42 138.511C292.181 138.106 291.805 137.903 291.292 137.903C290.794 137.903 290.425 138.096 290.186 138.482C289.952 138.863 289.827 139.461 289.812 140.276V142.869C289.812 143.738 289.93 144.385 290.164 144.81C290.403 145.23 290.784 145.44 291.307 145.44C291.824 145.44 292.198 145.237 292.427 144.832C292.657 144.427 292.776 143.807 292.786 142.972V140.438Z" fill="white"/>
                    <path id="pointer" fill="#131313" d="M159.998,161.48c-7.885-0.002-14.276-6.395-14.275-14.281
                    c0.001-5.703,3.396-10.859,8.636-13.113l5.745-59.939l5.928,60.117c7.146,3.334,10.236,11.83,6.902,18.975
                    C170.589,158.266,165.545,161.479,159.998,161.48z M160.423,137.967c-4.87,0-8.817,3.947-8.817,8.816
                    c0,4.871,3.948,8.818,8.817,8.818c4.869,0,8.817-3.947,8.817-8.818C169.234,141.916,165.29,137.973,160.423,137.967z"/>
                </svg>

                <?php $attrubiutes = array('id' => 'addForm');
                echo form_open('feedback/save', $attrubiutes); ?>
                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $doctor_id; ?>" >
                    <input type="hidden" name="answer" id="answer" value="" />
                    <input type="hidden" name="question" id="question" value="question1" >
                <?php echo form_close(); ?>

                <div id="status"></div>
                <button class="btn btn-success mt-5" name="next" id="next-button" onclick="next();" style="display:none;">Next</button>

            </div>
            <div class="col-md-12" id="next" style="display:none;">
                <!-- <button class="btn btn-success" name="next" id="next-button" onclick="next();">Next</button> -->
                <!-- <a href="<?php echo base_url('feedback/question2/') ?>" class="btn btn-success" onclick="next();"> Next </a> -->
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript">
        var allStates = $("svg.us > *");
        allStates.on("click", function() {
            var val = $(this).attr('data-pointer');
            var deg = $(this).attr('data-deg');
            $('#status').html("");
            $('#pointer').removeClass();
            $('#pointer').css('transform', 'rotate(' + deg + ')')
            $('#pointer').addClass("pointer" + val);  
            emoji(val);
            $("#answer").val(val);
            $("#next-button").show();
        });

        function emoji(point) {
            if (point <= 2) {
                $('#status').append("<img src='<?php echo base_url('assets/images/terrible.png'); ?>'> <h3 class='text-center'>Terrible</h3>");
                console.log('terrible');
            } else if (point >= 3 && point <= 4) {
                $('#status').append("<img src='<?php echo base_url('assets/images/bad.png'); ?>'> <h3 class='text-center'>Bad</h3>");
                console.log('Bad');
            } else if (point >= 5 && point <= 6) {
                $('#status').append("<img src='<?php echo base_url('assets/images/okay.png'); ?>'> <h3 class='text-center'>Okay</h3>");
                console.log('Okay');
            } else if (point >= 7 && point <= 8) {
                $('#status').append("<img src='<?php echo base_url('assets/images/good.png'); ?>'> <h3 class='text-center'>Good</h3>");
                console.log('Good');
            } else if (point >= 9 && point <= 10) {
                $('#status').append("<img src='<?php echo base_url('assets/images/great.png'); ?>'> <h3 class='text-center'>Great</h3>");
                console.log('Great');
            }
        }

        function next(){
            var answer = $("#answer").val;
            if(answer == ''){
                location.reload();
            }
            var url = $('#addForm').attr('action');
            $.ajax({
                type: "POST",
                url: url, 
                data: $('#addForm').serialize(),
                dataType: "json",  
                cache:false,
                success: function (response) {
                    if (response.status) {
					window.location.href = (response.redirectTo) ? response.redirectTo : '';
				    }
                }
            });
        }
    </script>
</body>

</html>