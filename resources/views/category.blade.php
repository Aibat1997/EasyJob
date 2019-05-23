<select name="category" id="category">
    <option value="" selected></option>
    <option value="Торговля" @if(old('category') == 'Торговля')selected @endif>Торговля</option>
    <option value="Транспорт" @if(old('category') == 'Транспорт')selected @endif>Транспорт</option>
    <option value="Строительство" @if(old('category') == 'Строительство')selected @endif>Строительство</option>
    <option value="Охрана" @if(old('category') == 'Охрана')selected @endif>Охрана</option>
    <option value="Хозяйство" @if(old('category') == 'Хозяйство')selected @endif>Хозяйство</option>
</select>
