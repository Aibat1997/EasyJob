<select name="region" id="region">
    <option value="" selected></option>
    <option value="Турксибский" @if(old('region') == 'Турксибский')selected @endif>Турксибский район</option>
    <option value="Наурызбайский" @if(old('region') == 'Наурызбайский')selected @endif>Наурызбайский район</option>
    <option value="Медеуский" @if(old('region') == 'Медеуский')selected @endif>Медеуский район</option>
    <option value="Жетысуский" @if(old('region') == 'Жетысуский')selected @endif>Жетысуский район</option>
    <option value="Бостандыкский" @if(old('region') == 'Бостандыкский')selected @endif>Бостандыкский район</option>
    <option value="Ауэзовский" @if(old('region') == 'Ауэзовский')selected @endif>Ауэзовский район</option>
    <option value="Алмалинский" @if(old('region') == 'Алмалинский')selected @endif>Алмалинский район</option>
    <option value="Алатауский" @if(old('region') == 'Алатауский')selected @endif>Алатауский район</option>
</select>