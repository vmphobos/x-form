## Introduction

X-Form is a fully customized package of Blade components made for Laravel 10, Livewire 3 and Bootstrap v.5.

### Format
X-Form is easy to use and easier to update class styles by editing the x-form configuration accordingly
```
<x-form.tag_name_goes_here 
  model="livewire_model_name_here"
  label="the title of the field can also be html" 
  modifier="optional:live,blur etc." 
/>  
```

### Input
A fully customized bootstrap styled input including label, validation and input tag by default to save space and time
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
<x-select :list="$this->yourList" model="country" label="Country Of Origin" />
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
    :list="$this->countries"
    label="Countries"
    model="countries"
    toggle="yourClickFunctionForSelectingAllEuropeCountries"
    tooltip-key="description"
    grouped required
/>
```

