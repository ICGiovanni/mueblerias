<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    //include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>
<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Agregar Producto</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Productos</a>
                </li>
                <li class="active">
                    <strong>Agregar Producto</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./index.php" class="btn btn-danger btn-xs"><i class="fa fa-arrow-left"></i> Regresar a listado</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
		<form method="get" class="form-horizontal" action="/" id="form_productos">
			<div class="form-group">
            <label class="col-sm-2 control-label">SKU</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="sku" name="sku"></div>
            </div>
			<div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-6" ><input type="text" class="form-control" id="nombre" name="nombre"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Descripción</label>
			<div class="col-sm-6" ><textarea class="form-control" id="descripcion" name="descripcion"></textarea></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Apellido Materno</label>
                <label class="font-noraml">Multi select</label>
                <div class="input-group">
                <select tabindex="-1" style="width: 350px; display: none;" multiple="" class="chosen-select" data-placeholder="Choose a Country..." id="color">
                <option value="">Select</option>
                <option value="United States">United States</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Aland Islands">Aland Islands</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
                <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Curacao">Curacao</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guernsey">Guernsey</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-bissau">Guinea-bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India" selected="">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jersey">Jersey</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libya">Libya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="Moldova, Republic of">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru" selected="">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Barthelemy">Saint Barthelemy</option>
                <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Martin (French part)">Saint Martin (French part)</option>
                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                <option value="South Sudan">South Sudan</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-leste">Timor-leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
                <option value="Viet Nam">Viet Nam</option>
                <option value="Virgin Islands, British">Virgin Islands, British</option>
                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna">Wallis and Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
                </select><div class="chosen-container chosen-container-multi" style="width: 350px;" title=""><ul class="chosen-choices"><li class="search-field"><input type="text" style="width: 140px;" autocomplete="off" class="default" value="Choose a Country..." tabindex="4"></li></ul><div class="chosen-drop"><ul class="chosen-results"><li class="active-result" style="" data-option-array-index="0">Select</li><li class="active-result" style="" data-option-array-index="1">United States</li><li class="active-result" style="" data-option-array-index="2">United Kingdom</li><li class="active-result" style="" data-option-array-index="3">Afghanistan</li><li class="active-result" style="" data-option-array-index="4">Aland Islands</li><li class="active-result" style="" data-option-array-index="5">Albania</li><li class="active-result" style="" data-option-array-index="6">Algeria</li><li class="active-result" style="" data-option-array-index="7">American Samoa</li><li class="active-result" style="" data-option-array-index="8">Andorra</li><li class="active-result" style="" data-option-array-index="9">Angola</li><li class="active-result" style="" data-option-array-index="10">Anguilla</li><li class="active-result" style="" data-option-array-index="11">Antarctica</li><li class="active-result" style="" data-option-array-index="12">Antigua and Barbuda</li><li class="active-result" style="" data-option-array-index="13">Argentina</li><li class="active-result" style="" data-option-array-index="14">Armenia</li><li class="active-result" style="" data-option-array-index="15">Aruba</li><li class="active-result" style="" data-option-array-index="16">Australia</li><li class="active-result" style="" data-option-array-index="17">Austria</li><li class="active-result" style="" data-option-array-index="18">Azerbaijan</li><li class="active-result" style="" data-option-array-index="19">Bahamas</li><li class="active-result" style="" data-option-array-index="20">Bahrain</li><li class="active-result" style="" data-option-array-index="21">Bangladesh</li><li class="active-result" style="" data-option-array-index="22">Barbados</li><li class="active-result" style="" data-option-array-index="23">Belarus</li><li class="active-result" style="" data-option-array-index="24">Belgium</li><li class="active-result" style="" data-option-array-index="25">Belize</li><li class="active-result" style="" data-option-array-index="26">Benin</li><li class="active-result" style="" data-option-array-index="27">Bermuda</li><li class="active-result" style="" data-option-array-index="28">Bhutan</li><li class="active-result" style="" data-option-array-index="29">Bolivia, Plurinational State of</li><li class="active-result" style="" data-option-array-index="30">Bonaire, Sint Eustatius and Saba</li><li class="active-result" style="" data-option-array-index="31">Bosnia and Herzegovina</li><li class="active-result" style="" data-option-array-index="32">Botswana</li><li class="active-result" style="" data-option-array-index="33">Bouvet Island</li><li class="active-result" style="" data-option-array-index="34">Brazil</li><li class="active-result" style="" data-option-array-index="35">British Indian Ocean Territory</li><li class="active-result" style="" data-option-array-index="36">Brunei Darussalam</li><li class="active-result" style="" data-option-array-index="37">Bulgaria</li><li class="active-result" style="" data-option-array-index="38">Burkina Faso</li><li class="active-result" style="" data-option-array-index="39">Burundi</li><li class="active-result" style="" data-option-array-index="40">Cambodia</li><li class="active-result" style="" data-option-array-index="41">Cameroon</li><li class="active-result" style="" data-option-array-index="42">Canada</li><li class="active-result" style="" data-option-array-index="43">Cape Verde</li><li class="active-result" style="" data-option-array-index="44">Cayman Islands</li><li class="active-result" style="" data-option-array-index="45">Central African Republic</li><li class="active-result" style="" data-option-array-index="46">Chad</li><li class="active-result" style="" data-option-array-index="47">Chile</li><li class="active-result" style="" data-option-array-index="48">China</li><li class="active-result" style="" data-option-array-index="49">Christmas Island</li><li class="active-result" style="" data-option-array-index="50">Cocos (Keeling) Islands</li><li class="active-result" style="" data-option-array-index="51">Colombia</li><li class="active-result" style="" data-option-array-index="52">Comoros</li><li class="active-result" style="" data-option-array-index="53">Congo</li><li class="active-result" style="" data-option-array-index="54">Congo, The Democratic Republic of The</li><li class="active-result" style="" data-option-array-index="55">Cook Islands</li><li class="active-result" style="" data-option-array-index="56">Costa Rica</li><li class="active-result" style="" data-option-array-index="57">Cote D'ivoire</li><li class="active-result" style="" data-option-array-index="58">Croatia</li><li class="active-result" style="" data-option-array-index="59">Cuba</li><li class="active-result" style="" data-option-array-index="60">Curacao</li><li class="active-result" style="" data-option-array-index="61">Cyprus</li><li class="active-result" style="" data-option-array-index="62">Czech Republic</li><li class="active-result" style="" data-option-array-index="63">Denmark</li><li class="active-result" style="" data-option-array-index="64">Djibouti</li><li class="active-result" style="" data-option-array-index="65">Dominica</li><li class="active-result" style="" data-option-array-index="66">Dominican Republic</li><li class="active-result" style="" data-option-array-index="67">Ecuador</li><li class="active-result" style="" data-option-array-index="68">Egypt</li><li class="active-result" style="" data-option-array-index="69">El Salvador</li><li class="active-result" style="" data-option-array-index="70">Equatorial Guinea</li><li class="active-result" style="" data-option-array-index="71">Eritrea</li><li class="active-result" style="" data-option-array-index="72">Estonia</li><li class="active-result" style="" data-option-array-index="73">Ethiopia</li><li class="active-result" style="" data-option-array-index="74">Falkland Islands (Malvinas)</li><li class="active-result" style="" data-option-array-index="75">Faroe Islands</li><li class="active-result" style="" data-option-array-index="76">Fiji</li><li class="active-result" style="" data-option-array-index="77">Finland</li><li class="active-result" style="" data-option-array-index="78">France</li><li class="active-result" style="" data-option-array-index="79">French Guiana</li><li class="active-result" style="" data-option-array-index="80">French Polynesia</li><li class="active-result" style="" data-option-array-index="81">French Southern Territories</li><li class="active-result" style="" data-option-array-index="82">Gabon</li><li class="active-result" style="" data-option-array-index="83">Gambia</li><li class="active-result" style="" data-option-array-index="84">Georgia</li><li class="active-result" style="" data-option-array-index="85">Germany</li><li class="active-result" style="" data-option-array-index="86">Ghana</li><li class="active-result" style="" data-option-array-index="87">Gibraltar</li><li class="active-result" style="" data-option-array-index="88">Greece</li><li class="active-result" style="" data-option-array-index="89">Greenland</li><li class="active-result" style="" data-option-array-index="90">Grenada</li><li class="active-result" style="" data-option-array-index="91">Guadeloupe</li><li class="active-result" style="" data-option-array-index="92">Guam</li><li class="active-result" style="" data-option-array-index="93">Guatemala</li><li class="active-result" style="" data-option-array-index="94">Guernsey</li><li class="active-result" style="" data-option-array-index="95">Guinea</li><li class="active-result" style="" data-option-array-index="96">Guinea-bissau</li><li class="active-result" style="" data-option-array-index="97">Guyana</li><li class="active-result" style="" data-option-array-index="98">Haiti</li><li class="active-result" style="" data-option-array-index="99">Heard Island and Mcdonald Islands</li><li class="active-result" style="" data-option-array-index="100">Holy See (Vatican City State)</li><li class="active-result" style="" data-option-array-index="101">Honduras</li><li class="active-result" style="" data-option-array-index="102">Hong Kong</li><li class="active-result" style="" data-option-array-index="103">Hungary</li><li class="active-result" style="" data-option-array-index="104">Iceland</li><li class="active-result" style="" data-option-array-index="105">India</li><li class="active-result" style="" data-option-array-index="106">Indonesia</li><li class="active-result" style="" data-option-array-index="107">Iran, Islamic Republic of</li><li class="active-result" style="" data-option-array-index="108">Iraq</li><li class="active-result" style="" data-option-array-index="109">Ireland</li><li class="active-result" style="" data-option-array-index="110">Isle of Man</li><li class="active-result" style="" data-option-array-index="111">Israel</li><li class="active-result" style="" data-option-array-index="112">Italy</li><li class="active-result" style="" data-option-array-index="113">Jamaica</li><li class="active-result" style="" data-option-array-index="114">Japan</li><li class="active-result" style="" data-option-array-index="115">Jersey</li><li class="active-result" style="" data-option-array-index="116">Jordan</li><li class="active-result" style="" data-option-array-index="117">Kazakhstan</li><li class="active-result" style="" data-option-array-index="118">Kenya</li><li class="active-result" style="" data-option-array-index="119">Kiribati</li><li class="active-result" style="" data-option-array-index="120">Korea, Democratic People's Republic of</li><li class="active-result" style="" data-option-array-index="121">Korea, Republic of</li><li class="active-result" style="" data-option-array-index="122">Kuwait</li><li class="active-result" style="" data-option-array-index="123">Kyrgyzstan</li><li class="active-result" style="" data-option-array-index="124">Lao People's Democratic Republic</li><li class="active-result" style="" data-option-array-index="125">Latvia</li><li class="active-result" style="" data-option-array-index="126">Lebanon</li><li class="active-result" style="" data-option-array-index="127">Lesotho</li><li class="active-result" style="" data-option-array-index="128">Liberia</li><li class="active-result" style="" data-option-array-index="129">Libya</li><li class="active-result" style="" data-option-array-index="130">Liechtenstein</li><li class="active-result" style="" data-option-array-index="131">Lithuania</li><li class="active-result" style="" data-option-array-index="132">Luxembourg</li><li class="active-result" style="" data-option-array-index="133">Macao</li><li class="active-result" style="" data-option-array-index="134">Macedonia, The Former Yugoslav Republic of</li><li class="active-result" style="" data-option-array-index="135">Madagascar</li><li class="active-result" style="" data-option-array-index="136">Malawi</li><li class="active-result" style="" data-option-array-index="137">Malaysia</li><li class="active-result" style="" data-option-array-index="138">Maldives</li><li class="active-result" style="" data-option-array-index="139">Mali</li><li class="active-result" style="" data-option-array-index="140">Malta</li><li class="active-result" style="" data-option-array-index="141">Marshall Islands</li><li class="active-result" style="" data-option-array-index="142">Martinique</li><li class="active-result" style="" data-option-array-index="143">Mauritania</li><li class="active-result" style="" data-option-array-index="144">Mauritius</li><li class="active-result" style="" data-option-array-index="145">Mayotte</li><li class="active-result" style="" data-option-array-index="146">Mexico</li><li class="active-result" style="" data-option-array-index="147">Micronesia, Federated States of</li><li class="active-result" style="" data-option-array-index="148">Moldova, Republic of</li><li class="active-result" style="" data-option-array-index="149">Monaco</li><li class="active-result" style="" data-option-array-index="150">Mongolia</li><li class="active-result" style="" data-option-array-index="151">Montenegro</li><li class="active-result" style="" data-option-array-index="152">Montserrat</li><li class="active-result" style="" data-option-array-index="153">Morocco</li><li class="active-result" style="" data-option-array-index="154">Mozambique</li><li class="active-result" style="" data-option-array-index="155">Myanmar</li><li class="active-result" style="" data-option-array-index="156">Namibia</li><li class="active-result" style="" data-option-array-index="157">Nauru</li><li class="active-result" style="" data-option-array-index="158">Nepal</li><li class="active-result" style="" data-option-array-index="159">Netherlands</li><li class="active-result" style="" data-option-array-index="160">New Caledonia</li><li class="active-result" style="" data-option-array-index="161">New Zealand</li><li class="active-result" style="" data-option-array-index="162">Nicaragua</li><li class="active-result" style="" data-option-array-index="163">Niger</li><li class="active-result" style="" data-option-array-index="164">Nigeria</li><li class="active-result" style="" data-option-array-index="165">Niue</li><li class="active-result" style="" data-option-array-index="166">Norfolk Island</li><li class="active-result" style="" data-option-array-index="167">Northern Mariana Islands</li><li class="active-result" style="" data-option-array-index="168">Norway</li><li class="active-result" style="" data-option-array-index="169">Oman</li><li class="active-result" style="" data-option-array-index="170">Pakistan</li><li class="active-result" style="" data-option-array-index="171">Palau</li><li class="active-result" style="" data-option-array-index="172">Palestinian Territory, Occupied</li><li class="active-result" style="" data-option-array-index="173">Panama</li><li class="active-result" style="" data-option-array-index="174">Papua New Guinea</li><li class="active-result" style="" data-option-array-index="175">Paraguay</li><li class="active-result" style="" data-option-array-index="176">Peru</li><li class="active-result" style="" data-option-array-index="177">Philippines</li><li class="active-result" style="" data-option-array-index="178">Pitcairn</li><li class="active-result" style="" data-option-array-index="179">Poland</li><li class="active-result" style="" data-option-array-index="180">Portugal</li><li class="active-result" style="" data-option-array-index="181">Puerto Rico</li><li class="active-result" style="" data-option-array-index="182">Qatar</li><li class="active-result" style="" data-option-array-index="183">Reunion</li><li class="active-result" style="" data-option-array-index="184">Romania</li><li class="active-result" style="" data-option-array-index="185">Russian Federation</li><li class="active-result" style="" data-option-array-index="186">Rwanda</li><li class="active-result" style="" data-option-array-index="187">Saint Barthelemy</li><li class="active-result" style="" data-option-array-index="188">Saint Helena, Ascension and Tristan da Cunha</li><li class="active-result" style="" data-option-array-index="189">Saint Kitts and Nevis</li><li class="active-result" style="" data-option-array-index="190">Saint Lucia</li><li class="active-result" style="" data-option-array-index="191">Saint Martin (French part)</li><li class="active-result" style="" data-option-array-index="192">Saint Pierre and Miquelon</li><li class="active-result" style="" data-option-array-index="193">Saint Vincent and The Grenadines</li><li class="active-result" style="" data-option-array-index="194">Samoa</li><li class="active-result" style="" data-option-array-index="195">San Marino</li><li class="active-result" style="" data-option-array-index="196">Sao Tome and Principe</li><li class="active-result" style="" data-option-array-index="197">Saudi Arabia</li><li class="active-result" style="" data-option-array-index="198">Senegal</li><li class="active-result" style="" data-option-array-index="199">Serbia</li><li class="active-result" style="" data-option-array-index="200">Seychelles</li><li class="active-result" style="" data-option-array-index="201">Sierra Leone</li><li class="active-result" style="" data-option-array-index="202">Singapore</li><li class="active-result" style="" data-option-array-index="203">Sint Maarten (Dutch part)</li><li class="active-result" style="" data-option-array-index="204">Slovakia</li><li class="active-result" style="" data-option-array-index="205">Slovenia</li><li class="active-result" style="" data-option-array-index="206">Solomon Islands</li><li class="active-result" style="" data-option-array-index="207">Somalia</li><li class="active-result" style="" data-option-array-index="208">South Africa</li><li class="active-result" style="" data-option-array-index="209">South Georgia and The South Sandwich Islands</li><li class="active-result" style="" data-option-array-index="210">South Sudan</li><li class="active-result" style="" data-option-array-index="211">Spain</li><li class="active-result" style="" data-option-array-index="212">Sri Lanka</li><li class="active-result" style="" data-option-array-index="213">Sudan</li><li class="active-result" style="" data-option-array-index="214">Suriname</li><li class="active-result" style="" data-option-array-index="215">Svalbard and Jan Mayen</li><li class="active-result" style="" data-option-array-index="216">Swaziland</li><li class="active-result" style="" data-option-array-index="217">Sweden</li><li class="active-result" style="" data-option-array-index="218">Switzerland</li><li class="active-result" style="" data-option-array-index="219">Syrian Arab Republic</li><li class="active-result" style="" data-option-array-index="220">Taiwan, Province of China</li><li class="active-result" style="" data-option-array-index="221">Tajikistan</li><li class="active-result" style="" data-option-array-index="222">Tanzania, United Republic of</li><li class="active-result" style="" data-option-array-index="223">Thailand</li><li class="active-result" style="" data-option-array-index="224">Timor-leste</li><li class="active-result" style="" data-option-array-index="225">Togo</li><li class="active-result" style="" data-option-array-index="226">Tokelau</li><li class="active-result" style="" data-option-array-index="227">Tonga</li><li class="active-result" style="" data-option-array-index="228">Trinidad and Tobago</li><li class="active-result" style="" data-option-array-index="229">Tunisia</li><li class="active-result" style="" data-option-array-index="230">Turkey</li><li class="active-result" style="" data-option-array-index="231">Turkmenistan</li><li class="active-result" style="" data-option-array-index="232">Turks and Caicos Islands</li><li class="active-result" style="" data-option-array-index="233">Tuvalu</li><li class="active-result" style="" data-option-array-index="234">Uganda</li><li class="active-result" style="" data-option-array-index="235">Ukraine</li><li class="active-result" style="" data-option-array-index="236">United Arab Emirates</li><li class="active-result" style="" data-option-array-index="237">United Kingdom</li><li class="active-result" style="" data-option-array-index="238">United States</li><li class="active-result" style="" data-option-array-index="239">United States Minor Outlying Islands</li><li class="active-result" style="" data-option-array-index="240">Uruguay</li><li class="active-result" style="" data-option-array-index="241">Uzbekistan</li><li class="active-result" style="" data-option-array-index="242">Vanuatu</li><li class="active-result" style="" data-option-array-index="243">Venezuela, Bolivarian Republic of</li><li class="active-result" style="" data-option-array-index="244">Viet Nam</li><li class="active-result" style="" data-option-array-index="245">Virgin Islands, British</li><li class="active-result" style="" data-option-array-index="246">Virgin Islands, U.S.</li><li class="active-result" style="" data-option-array-index="247">Wallis and Futuna</li><li class="active-result" style="" data-option-array-index="248">Western Sahara</li><li class="active-result" style="" data-option-array-index="249">Yemen</li><li class="active-result" style="" data-option-array-index="250">Zambia</li><li class="active-result" style="" data-option-array-index="251">Zimbabwe</li></ul></div></div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Raz&oacute;n Social</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="razonS" name="razonS"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">RFC</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="rfc" name="rfc"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Calle</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="calle" name="calle"></div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label">No. Exterior</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="noExt" name="noExt"></div>
			<label class="col-sm-2 control-label">No. Interior</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="noInt" name="noInt"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Colonia</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="colonia" name="colonia"></div>
            </div>
            <div class="form-group">
			<label class="col-sm-2 control-label">C.P.</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="codigoPostal" name="codigoPostal"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Municipio</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="municipio" name="municipio"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Estado</label>
			<div class="col-sm-6">
			<select id="estado" name="estado" class="form-control m-b">
            <option value="">Seleccione un Estado</option>
            </select>
			</div>
			</div>
            <div class="form-group">
            <label class="col-sm-2 control-label">Telefono</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="telefono" name="telefono"></div>
			<label class="col-sm-2 control-label">Telefono Alterno</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="telefonoA" name="telefonoA"></div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label">Celular</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="celular" name="celular"></div>
			<label class="col-sm-2 control-label">Celular Alterno</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="celularA" name="celularA"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">E-mail</label>
			<div class="col-sm-6" id="divEmail"><input type="text" class="form-control" id="email" name="email"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">E-mail Alterno</label>
			<div class="col-sm-6" id="divEmail"><input type="text" class="form-control" id="emailA" name="emailA"></div>
            </div>
            <div class="form-group">
			<div class="col-sm-6 col-sm-offset-2" align="right"><br>
			<button class="btn btn-danger btn-xs" id="cancelar" type="button">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary btn-xs" id="guardar" type="button">Guardar Cliente</button>
			</div>
			</div>
        
		</form>
	</div>

<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>

<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
<script>
$(document).ready(function()
{

	toastr.options=
	{
		  "closeButton": true,
		  "debug": false,
		  "progressBar": true,
		  "preventDuplicates": false,
		  "positionClass": "toast-top-right",
		  "onclick": null,
		  "showDuration": "400",
		  "hideDuration": "1000",
		  "timeOut": "7000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
	}
	
	$("#sku").focus();

	$( "#guardar" ).click(function()
	{
		var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
		if($("#nombre").val()=='')
		{
			toastr.error('Debe de agregar un Nombre');
			$("#nombre").val('');
			$("#nombre").focus();		
		}
		else if($("#apellidoP").val()=='')
		{
			toastr.error('Debe de agregar un Apellido Paterno');
			$("#apellidoP").val('');
			$("#apellidoP").focus();		
		}
		else if($("#apellidoM").val()=='')
		{
			toastr.error('Debe de agregar un Apellido Materno');
			$("#apellidoM").val('');
			$("#apellidoM").focus();		
		}
		else if($("#telefono").val()=='')
		{
			toastr.error('Debe de agregar un Telefono');
			$("#telefono").val('');
			$("#telefono").focus();
		}
		else if(!email_regex.test($("#email").val()))
		{
			toastr.error('Debe de agregar un E-mail valido');
			$("#email").val('');
			$("#email").focus();
		}
		else
		{
			var url="guardar_cliente.php";
			 
			$.ajax(
			{
		    	type: "POST",
		        url: url,
		        data: $("#form_cliente").serialize(), // serializes the form's elements.
		        success: function(data)
		        {
		        	alert("El Cliente ha sido registrado"); // show response from the php script.
		        	var url="index.php";
		    		$(location).attr("href", url);
				}
			});

			
		}
	});
	
	$( "#cancelar" ).click(function()
	{
		var url="index.php";
		$(location).attr("href", url);
	});

	$("#color").chosen({allow_single_deselect:true});

});
</script>


   

<?php
    include $pathProy.'footer.php';
?>