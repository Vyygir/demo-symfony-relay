# Relay

>[!IMPORTANT]
>Relay is _purely_ a demonstration of a project that has already been built, to prove whether it can be done without 
>relying on a client-side framework. I would highly advise **against** arbitrarily deploying this to a production 
>server but... you do you.

### Purpose

The whole point of Relay was to demonstratively prove the idea that not _all_ applications need to be client-side. At 
this point in time, everyone and their mother's has written something in React, Vue, Angular, or one of the plethora of 
variants.

This project proves that, for simple interactivity, form processing, validation, and data-capture, we don't need to 
rely on the "modern" paradigm of web applications... mostly.

### Trials

Quite blatantly, this project relies entirely on the [Symfony](https://symfony.com/) framework.

As well as the framework, we also us [Turbo](https://ux.symfony.com/turbo) and 
[Live Components](https://ux.symfony.com/live-component). These are the driving forces behind a huge amount of the 
implementations and logic. And the beauty of both? The setup was fairly minimal and I could continue in just building 
an application, using components where needed.

The whole premise of _live_ components from a PHP backed ecosystem are somewhat enticing; its utilisation in the 
project has really shaped the purpose. There's definitely a lot that can be done that isn't demonstrated in Relay. 
This may not even be the perfect use-case or example of how live components are best implemented, but they work as 
they need to.

Everything is a request to the server, as expected, while the pages (and, in some cases, only frames) are updated via 
AJAX calls. With that, we have considerations the same as a client-side framework would; some the same, some differing 
entirely. Yet it still proves that we can make something _interactive_ and _shiny_ and _flashy_, without raw investment 
in JavaScript.

### Tribulations

The learning curve to Live Components alone is, indeed, a challenge. The components themselves are fairly simplistic 
but the real challenge appears when you need to re-understand the lifecycle of a "live" view.

The data modelling also proposed a challenge. We don't necessarily want to be creating tables from static data.

>_Oh, but you could have used fixtures!_

...and?

I didn't. Oh, well. The earth, she spins.

The products, in the real version, are actually static in a configuration file because... well, we never needed them to 
be manageable. The back-end and implementation which relies on WordPress is forever in a state of flux. So, call this 
an ode to that.

Yes, I created a `ProductsConfiguration` object, purely to load products statically from a YAML file. And you just have 
to live with that, no matter how much you hate it.

Another struggle came from the "scope": one does not exist.

There is a real version of this, and the goal was to emulate that as close as possible. As far as functionality goes, 
it's very, very close. But this led to a few issues with my own wanton of implementations. If we don't have a real 
back-end to handle something, much like products, then we end up stagnant because there's nothing to replicate here.

### Demonstration

![Relay demonstration](demo/relay-mvp.gif)
[_Watch a decent quality version here_](demo/relay-mvp.mp4)

### Outcome

After this entire experience, I've both found some of my favourite things about Symfony, whilst simultaneously 
discovering the pain points I dislike. This is purely a preference, but I've 
[said similar things about Tempest](https://starle.sh/tempest-the-journey-thus-far). That doesn't mean I don't still 
enjoy the concept of the framework, the notion, or even the framework itself. It's just another element to mentally 
catalogue away for use when you need to weigh the use of a technical stack for a project.

Gradually, over time, I may still improve Relay. It was, mostly, enjoyable to work on and serves a real use-case for 
my current working environment.

#### Missing Pieces

We are still missing a few minor pieces that, frankly, weren't technically necessary for the initial version:

- The sidebar displays nothing on any view because.. well, nothing happens in the original. It's just content.
- We don't have any error pages, generic or specific
- We could probably consume query parameters for certain steps
- The connectivity status of an address isn't displayed anywhere
- Only one address can be consumed at the start, instead of many (two on the real version)
- The `Address` and `Product` entities are handled via embeddables instead because we don't need them to be their own 
  entities in the database. Not to say they _couldn't_ be; it's just they aren't.
- The Tailwind implementation, and styling in general, is half-baked.
- Fairly obviously, there's no real connectivity status check. That felt like mocking an API for naught.

Again, at some point, I might come back and address these. This was an attempt at porting something into Symfony, 
purely to see if it could be, and I'm not finished with that dive yet.

