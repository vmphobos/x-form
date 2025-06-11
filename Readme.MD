## Introduction

X-Form is a fully customized package of Blade components made for Laravel 10+. Using Livewire 3+, Latest Tailwind CSS and AlpineJS.
To add to your project from the console run:
```
composer require vmphobos/x-form
```
then you can use the following command to publish config and views:
```
php artisan x-form:install
```

### Available Tags
x-form.input, x-form.checkbox, x-form.radio, x-form.select, x-form.textarea, x-form.disabled, x-form.phones

### Format
The following syntax is used to render all the necessary form parts for your model's property.
```
<x-form.input
  model="Livewire/model property name goes here"
  label="The title of the field. Html is permitted"
  modifier="Livewire only: live, change etc."
/>
```

### Input
A fully customized bootstrap styled input including a label, validation and input tag by default
```
<x-form.input model="title" label="title" />
```
Make it required:
```
<x-form.input model="title" label="title" required />
```
Change the input tag type easily like this:
```
<x-form.input type="password" model="title" label="title" :required="$is_confirmed"/>
```

### Select
A select tag example with a computed livewire array list in the format of ['value' => 'title']. Not adding a list attribute will use the default list which is a boolean array (yes/no).
```
<x-form.select :list="$this->yourList" model="country" label="Country Of Origin" />
```
On your livewire component add your list like this by reverting pluck in order to keep any kind of ordering in the frontend:
```
#[Computed]
public function yourList(): array
{
  return YourModel::....pluck('option value', 'text title')->toArray();
}
```

### Checkboxes and Radio Buttons
Same as x-form select you can use an array for the list in the same format as in select.
```
<x-form.checkbox :list="$this->yourList" model="country" label="Country Of Origin" />
```
To make your checkbox or radio horizontal just add horizontal. By default horizontal is false
```
<x-form.radio :list="$this->yourList" model="country" label="Country Of Origin" horizontal />
```

### Grouped Checkbox
A grouped checkbox with tooltip and toggle action per group. Label takes the main header while the title per grouped list will be the key name of your array.
The toggle="funcionName" accepts the function that will handle the click event on each group category, for example selecting all group items.
The tooltip-key is available only on category items and it should be a key name that holds the info you would like to show to the user.
Let's assume you have the following array:
```
$countries = [
  'europe' => [
      [
        'id' => '55',
        'title' => 'Greece',
        'description' => 'Greece, officially the Hellenic Republic, is a country ..."
      ],
      [
        'id' => '111',
        'title' => 'Italy',
        'description' => 'Italy is a country ..."
      ],
  ],
];
```
Please note that when creating a function for the toggle action, it should always contain the array group index. In the above array this is the key "europe".
So your action when clicking on Europe should call:
```
public function yourFunction($category)
{
  // $category is 'europe'
}
```
Below is the format of a full group x-form checkbox with click event and tooltips per item.
```
<x-form.checkbox
    :list="$countries"
    label="Countries"
    model="countries"
    toggle="yourClickFunctionForSelectingAllEuropeCountries"
    tooltip-key="description"
    grouped required
/>
```

### Disabled Inputs
Disabled inputs are a great way of showing properties that are not editable to the user with an action like email, map, link, copy.
For example ```<x-form.disabled :value="$yourProperty" label="a title" copy />```
This will show a button to the input to copy its text. If you add link word instead of copy, it will show a button that will redirect the user to the link when clicked.
By default the copy uses Alpine functionality so you don't have to write any code.
