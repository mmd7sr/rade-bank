# UI Guidelines for Rade Bank Laravel Project

## Purpose

This document defines the frontend design and implementation standards for the Laravel banking dashboard project.  
All generated Blade views, layouts, components, and UI elements must follow these rules.

The visual direction should feel:

- Modern
- Clean
- Trustworthy
- Minimal but premium
- Persian-first
- RTL-first
- Dashboard-oriented
- Similar in clarity and confidence to modern banking products
- Not a landing page
- Not overly colorful
- Not playful or startup-like

This project should feel like a real financial dashboard used by actual users.

---

## Core Design Principles

### 1. Persian-first experience
All user-facing content must be written in Persian unless there is a strong technical reason not to.

Requirements:
- All page layouts must support RTL
- Persian labels, headings, helper texts, validation messages, and buttons
- Persian formatting for instructions and descriptions
- Inputs that accept numbers should still be visually clean in RTL layouts

### 2. Dashboard, not marketing site
The project is an authenticated banking panel, not a public homepage.

That means:
- Compact and structured layout
- Page title + short description
- Functional cards
- Data sections
- Result panels
- Soft emphasis on actions
- No giant hero sections
- No oversized illustrations
- No unnecessary promotional text

### 3. Financial trust feeling
The UI must feel safe and reliable.

Use:
- Neutral backgrounds
- Strong whitespace discipline
- Soft shadows
- Clear borders
- Calm color palette
- Predictable spacing
- Legible typography
- Simple transitions

Avoid:
- Loud gradients everywhere
- Neon colors
- Excessive animation
- Rounded cartoonish widgets
- Cluttered cards
- Aggressive visual noise

---

## Visual Style Guide

### Color direction
Use a calm banking-inspired palette:

- Background: very light gray or off-white
- Surface/cards: white
- Primary accent: deep blue, indigo, or elegant teal
- Success: green but muted
- Error: soft red
- Warning: amber/gold, lightly used
- Text primary: dark slate or near-black
- Text secondary: medium gray

Suggested Tailwind direction:
- `bg-slate-50`
- `bg-white`
- `text-slate-900`
- `text-slate-600`
- `border-slate-200`
- `blue/indigo` accents for actions
- `green-600` or `emerald-600` for success states
- `red-600` for errors

### Border radius
Use moderate radius:
- cards: `rounded-2xl`
- inputs/buttons: `rounded-xl`

Do not over-round everything.

### Shadows
Use soft shadows only:
- `shadow-sm`
- `shadow-md`

Avoid very strong shadow effects.

### Spacing
Spacing must be consistent and breathable:
- page sections: generous vertical spacing
- cards: `p-6` or `p-8`
- form field gaps: `space-y-4` or `space-y-5`
- grid gaps: `gap-4`, `gap-6`

---

## Typography

Typography should be clean and modern.

Rules:
- Use readable Persian-friendly fonts if available
- Strong hierarchy between title, subtitle, body, helper text
- Avoid giant text sizes
- Avoid decorative typography

Recommended hierarchy:
- Page title: bold, prominent, but not huge
- Section title: semibold
- Labels: medium weight
- Helper text: small and muted
- Result values: slightly larger and stronger than normal text

If no custom Persian font is configured yet, keep typography simple and consistent.

---

## Layout Standards

### App shell
Authenticated pages should follow a dashboard shell with:

- Top navigation or header
- Optional sidebar later
- Main content container
- Consistent page width
- Responsive design

### Content width
Use a centered container with sensible max width:
- `max-w-5xl`
- `max-w-6xl`
depending on page type

Do not stretch forms too wide.

### Page structure
Each page should usually include:

1. Page heading area
2. Short explanatory text
3. Main content card
4. Optional result card
5. Optional history or info section

Example structure:

- Heading
- Description
- Form card
- Response card
- Secondary info/help card

---

## Form Design Standards

Forms are a major part of this dashboard.  
They must feel secure, clear, and easy to use.

### Input styling
All inputs should be:
- full width
- soft bordered
- clean focus state
- comfortable height
- visually premium but understated

Suggested Tailwind style direction:
- `w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900`
- focus states:
  - `focus:border-blue-500`
  - `focus:ring-4`
  - `focus:ring-blue-100`
- disabled state should be visibly muted

### Labels
Each field must have:
- a clear Persian label
- optional helper text if needed

### Validation errors
Validation errors must:
- appear near the field
- be concise
- be in Persian
- use soft red styling
- not break layout

### Buttons
Primary actions should feel confident but not flashy.

Suggested direction:
- Dark blue / indigo button
- White text
- Rounded-xl
- Medium or semibold text
- Smooth hover/focus transitions

Secondary buttons should be neutral.

### Loading states
When actions are submitted:
- disable submit button
- show spinner or loading text
- prevent duplicate submission

---

## Card Components

Cards are the main building block of this dashboard.

Each card should have:
- white background
- subtle border
- soft shadow
- rounded corners
- enough padding
- clearly separated content

Common card types:
1. Form card
2. Result card
3. Status card
4. Quick action card
5. Information/help card

---

## Result Display Standards

API results must be displayed in a structured and reassuring way.

For inquiry or banking result cards:
- show a clear success/failure status
- group related values
- avoid dumping raw JSON directly to users
- use readable Persian labels
- allow technical payload inspection only if needed for admin/dev views

Example result fields for card-to-sheba:
- شماره کارت
- شماره شبا
- نام بانک
- وضعیت استعلام
- پیام

### Success result style
- subtle green badge or indicator
- readable field/value rows
- strong display for important values like Sheba

### Failure result style
- subtle red or amber alert card
- safe and user-friendly message
- no sensitive technical stack traces
- if possible, a retry suggestion

---

## Security and Privacy Rules in UI

Because this is a financial project, frontend must respect security awareness.

Rules:
- Never expose tokens, secrets, or internal exception traces
- Never show sensitive raw payloads to normal users
- Mask sensitive card values where appropriate
- Do not store sensitive data in local storage unless explicitly required and approved
- Do not over-log user-sensitive details in frontend scripts

If card number is displayed after submission, prefer masking:
- Example: `6037-99**-****-1234`

---

## Card-to-Sheba Page Requirements

The `card-to-sheba` page should include:

### Page header
- Persian title
- short helpful description
- professional banking tone

Example:
- Title: `تبدیل شماره کارت به شبا`
- Description: `شماره کارت بانکی خود را وارد کنید تا شماره شبا و اطلاعات مرتبط را مشاهده کنید.`

### Main form card
Include:
- card number input
- helper text
- submit button

Input behavior:
- accept only 16 digits
- support user-friendly formatting if implemented
- validation message in Persian
- preserve old input on validation errors

### Result card
After successful inquiry display:
- masked card number
- sheba number
- bank name
- response status
- optional API message

### Error state
If API request fails:
- show safe Persian error message
- keep form visible
- do not clear useful user context unnecessarily

---

## Blade Implementation Rules

All generated frontend code should:
- use Laravel Blade cleanly
- avoid duplicated markup where reusable partials/components make sense
- prefer maintainable structures
- keep logic minimal inside Blade
- move business logic out of views
- use sections/components for repeated cards, alerts, and form elements

### Preferred approach
Use:
- layout file
- reusable page header partial/component
- reusable alert component
- reusable form input component if practical

### Avoid
- giant monolithic Blade files
- inline business logic
- messy conditional rendering blocks without structure

---

## Tailwind Usage Rules

Tailwind should be used with discipline.

### Prefer
- utility classes grouped clearly
- consistent spacing scale
- repeated patterns extracted into components if needed

### Avoid
- extremely long unreadable class chains unless necessary
- random inconsistent spacing
- using many arbitrary values without reason

---

## Responsive Behavior

Pages must remain usable on mobile and tablet.

Requirements:
- cards stack vertically on smaller screens
- buttons remain accessible
- form fields remain full width
- important result values wrap safely
- no horizontal overflow

The mobile experience should still feel like a banking dashboard, not a broken desktop page.

---

## Tone and Microcopy

Microcopy should be:
- calm
- helpful
- precise
- trustworthy
- non-marketing
- non-hype

Good examples:
- `لطفاً شماره کارت ۱۶ رقمی را وارد کنید.`
- `نتیجه استعلام با موفقیت دریافت شد.`
- `در حال حاضر دریافت اطلاعات ممکن نیست. لطفاً کمی بعد دوباره تلاش کنید.`

Avoid:
- exaggerated excitement
- casual slang
- playful messages
- overly technical wording for normal users

---

## Interaction Quality

The experience should feel polished.

Include where appropriate:
- smooth hover states
- focus states
- disabled states
- transition duration consistency
- clear empty states
- clean alert states

Do not add unnecessary animation libraries.

---

## Suggested Components to Build

As the frontend grows, create reusable components for:

- Page header
- Dashboard card
- Form input
- Validation error text
- Submit button
- Status badge
- Alert box
- Result row
- Empty state
- Section divider

---

## Specific Instruction for Claude

When generating code for this project, always do the following:

1. Assume the project is a Persian RTL banking dashboard
2. Use a clean authenticated panel style
3. Prioritize trust, clarity, and simplicity
4. Keep forms and result cards highly usable
5. Write all user-facing UI text in Persian
6. Use Laravel Blade and Tailwind cleanly
7. Do not generate marketing-style hero sections
8. Do not generate colorful startup-style UI
9. Do not expose raw backend errors to users
10. Make every page production-minded, not demo-like

---

## Example Request Interpretation

If asked to build a page like `card-to-sheba`, you should generate:

- a proper page container
- Persian page heading
- explanatory text
- a clean form card
- validation error display
- a submit button with professional styling
- a structured result card
- responsive RTL layout
- visual consistency with a banking dashboard

---

## Future UI Direction

In future pages such as:
- wallet
- transaction history
- loan request
- inquiry logs
- profile/security settings

the same system should be preserved:
- clean financial dashboard
- structured information hierarchy
- minimal, premium, Persian-first presentation

---

## Final Rule

Every UI output must look like it belongs to one coherent banking product.

Consistency is mandatory.
