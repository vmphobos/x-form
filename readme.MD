## Introduction

X-Form is a fully customized package of Laravel blade components made for Livewire 3.

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

