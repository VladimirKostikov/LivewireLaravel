# ![Laravel Livewire Logo](https://picperf.io/https://laravelnews.s3.amazonaws.com/images/laravel-livewire.png)

# Laravel Livewire Project

This repository is created for practicing and showcasing skills with Laravel Livewire, a full-stack framework for Laravel that simplifies building dynamic interfaces without stepping outside the Laravel ecosystem.

## What is Livewire?

[Livewire](https://laravel-livewire.com/) is a Laravel library that allows you to create dynamic, reactive interfaces using Laravel components. Instead of writing JavaScript, you can use PHP and Blade templates to build interactive UIs.

Livewire offers a simple and powerful way to build modern, reactive interfaces in Laravel without the complexity of JavaScript frameworks.

## Features

- **Real-time UI updates:** Handle user interactions like clicks, inputs, etc., directly in PHP.
- **Component-based:** Break your interface down into small, reusable components.
- **Zero JavaScript required:** Although you can integrate JavaScript when necessary, most interactions can be handled with PHP alone.
- **Easily testable:** Write tests for your components just like you would for any other Laravel application.

## Installation

To get started with Laravel Livewire, you need to install the package via Composer.

```bash
composer require livewire/livewire
```

## Components


Livewire components are the core building blocks in Livewire. They encapsulate both the backend logic and the frontend UI in a single, reusable unit. Components in Livewire are classes that extend Livewire\Component and are usually paired with a corresponding Blade view.

Creating Components: You can create a new Livewire component using the Artisan command:

```bash
php artisan make:livewire ExampleComponent
```

This generates two files:

- **The component class**: app/Http/Livewire/ExampleComponent.php
- **The component view**: resources/views/livewire/example-component.blade.php

Rendering Components: Once created, a component can be included in any Blade template using the <livewire:example-component /> tag or the @livewire('example-component') directive.

Lifecycle Methods: Livewire components have lifecycle methods similar to those in JavaScript frameworks. Common methods include mount, render, updated, hydrate, and dehydrate. These methods allow you to manage component initialization, rendering, and updates.

## Properties

Properties in Livewire are public variables in the component class that are automatically available to the component's Blade view. These properties can hold data and state that you want to share between your PHP backend and your Blade frontend.

Defining Properties: You define properties as public variables within your component class:

```bash
class ExampleComponent extends Component
{
    public $title = 'Hello, World!';
}
```
This $title property can now be used directly in the corresponding Blade view:

```bash
<h1>{{ $title }}</h1>
```

Binding Properties: You can bind Livewire properties to form inputs and other HTML elements using the wire:model directive, which creates a two-way data binding between the property and the input:

```bash
<input type="text" wire:model="title">
```

Any change to the input field will automatically update the $title property, and vice versa.

Computed Properties: Livewire also supports computed properties, which are methods that return values based on other properties:

```bash
public function getGreetingProperty()
{
    return 'Hello, ' . $this->title;
}
```
In the Blade view, you can use this computed property like so:

```bash
<h1>{{ $this->greeting }}</h1>
```


## Actions

Actions in Livewire are methods defined in your component class that respond to user interactions, such as clicks, form submissions, or other events.

Defining Actions: You define actions as public methods within your component class:

```bash
class ExampleComponent extends Component
{
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }
}

```
Triggering Actions: In the Blade view, you can trigger these actions using the wire:click, wire:submit, or other event-based directives:

```bash
<button wire:click="increment">Increment</button>
```

When the button is clicked, the increment method is called, and the $count property is updated.

Passing Parameters to Actions: You can pass parameters to actions directly from the view:

```bash
<button wire:click="increment(2)">Increment by 2</button>
```
And handle them in the component:

```bash
public function increment($amount)
{
    $this->count += $amount;
}
```
Preventing Default Actions: If you need to prevent the default behavior of a form or a link, you can use wire:click.prevent or wire:submit.prevent:

```bash
<form wire:submit.prevent="save">
    <!-- Form fields -->
    <button type="submit">Save</button>
</form>

```



### Forms

Handling forms in Livewire is straightforward and can be done entirely in PHP without the need for additional JavaScript.

- **Form Binding with `wire:model`:** The `wire:model` directive allows you to bind form inputs directly to Livewire component properties, creating a two-way data binding. For example:

    ```blade
    <input type="text" wire:model="name">
    ```

    This binds the input value to the `$name` property in your Livewire component. Changes in the input field automatically update the property, and vice versa.

- **Form Submission:** You can handle form submissions using the `wire:submit.prevent` directive. This prevents the default form submission and allows Livewire to handle it:

    ```blade
    <form wire:submit.prevent="submitForm">
        <input type="text" wire:model="name">
        <button type="submit">Submit</button>
    </form>
    ```

    In the component, you define the `submitForm` method to handle the submission:

    ```php
    public function submitForm()
    {
        // Handle form submission logic
    }
    ```

- **Validation:** Livewire integrates seamlessly with Laravel’s validation system. You can validate form data directly in your component using `$this->validate()`:

    ```php
    public function submitForm()
    {
        $this->validate([
            'name' => 'required|min:3',
        ]);

        // Proceed with form submission logic
    }
    ```

    Alternatively, you can use `$this->validateOnly('propertyName')` for validating a single field as the user types.

### Events

Events in Livewire allow communication between components, as well as between JavaScript and PHP.

- **Emitting Events:** You can emit events from one component that other components can listen to:

    ```php
    public function addItem()
    {
        // Some logic
        $this->emit('itemAdded', $itemId);
    }
    ```

- **Listening for Events:** Components can listen for events using the `protected $listeners` property:

    ```php
    protected $listeners = ['itemAdded' => 'handleItemAdded'];

    public function handleItemAdded($itemId)
    {
        // Handle the event
    }
    ```

- **Browser Events:** You can also emit events that JavaScript can listen to using `emitTo` or `emitUp`:

    ```php
    $this->emit('refreshComponent');
    ```

    Then in your JavaScript:

    ```javascript
    Livewire.on('refreshComponent', () => {
        // Handle the event in JavaScript
    });
    ```

### Lifecycle Hooks

Livewire provides several lifecycle hooks that allow you to hook into the component's lifecycle stages, similar to hooks in JavaScript frameworks.

- **Mounting:** The `mount` method runs when the component is first instantiated. It is typically used to initialize properties or load data:

    ```php
    public function mount()
    {
        $this->name = 'John Doe';
    }
    ```

- **Rendering:** The `render` method is required in every component and is responsible for returning the component’s view:

    ```php
    public function render()
    {
        return view('livewire.example-component');
    }
    ```

- **Updating:** Livewire provides hooks that run before and after a component's properties are updated:

    ```php
    public function updatingName($value)
    {
        // Called before the name property is updated
    }

    public function updatedName($value)
    {
        // Called after the name property has been updated
    }
    ```

    These hooks can also be defined for all properties:

    ```php
    public function updating($name, $value)
    {
        // Called before any property is updated
    }

    public function updated($name, $value)
    {
        // Called after any property is updated
    }
    ```

- **Hydration and Dehydration:** These hooks allow you to run code when the component is being hydrated (reconstructed from a previous request) or dehydrated (preparing the component for serialization):

    ```php
    public function hydrate()
    {
        // Runs when the component is being hydrated
    }

    public function dehydrate()
    {
        // Runs when the component is being dehydrated
    }
    ```

    These hooks are useful for tasks like cleaning up data or initializing transient state.

### Summary

- **Forms:** Livewire simplifies form handling with `wire:model` for data binding, and `wire:submit.prevent` for form submission, while seamlessly integrating with Laravel's validation system.
- **Events:** Events in Livewire enable communication between components and between PHP and JavaScript.
- **Lifecycle Hooks:** Lifecycle hooks allow you to hook into different stages of a component's life, such as mounting, updating, and rendering.

Livewire’s approach to forms, events, and lifecycle management offers a clean and powerful way to build dynamic applications without leaving the PHP world.
