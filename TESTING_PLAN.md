# AMCSD Search Plugin - Playwright Testing Plan

## Prerequisites

1. **Sandboxed environment** — Local VM or container running WordPress with the plugin activated
2. **Node.js** — v18+ installed on the test runner machine
3. **Network access** — Test runner must reach the WordPress instance

## Setup Steps

### 1. Initialize Node.js and install Playwright

```bash
npm init -y
npm install --save-dev @playwright/test
npx playwright install chromium  # or install all browsers
```

### 2. Create Playwright config

Create `playwright.config.ts` in project root:

```ts
import { defineConfig } from '@playwright/test';

export default defineConfig({
  testDir: './tests/e2e',
  timeout: 30_000,
  use: {
    baseURL: 'https://your-sandbox-url.example/amcsd',
    screenshot: 'only-on-failure',
    trace: 'retain-on-failure',
  },
  projects: [
    { name: 'chromium', use: { browserName: 'chromium' } },
  ],
});
```

### 3. Directory structure

```
tests/
  e2e/
    search-form.spec.ts       # Core form interaction tests
    periodic-table.spec.ts    # Chemistry/periodic table tests
    cell-parameters.spec.ts   # Cell parameter input tests
    screenshots/              # Baseline screenshots (generated)
```

### 4. Add npm scripts to package.json

```json
{
  "scripts": {
    "test": "npx playwright test",
    "test:headed": "npx playwright test --headed",
    "test:ui": "npx playwright test --ui",
    "test:update-snapshots": "npx playwright test --update-snapshots"
  }
}
```

### 5. Add to .gitignore

```
node_modules/
test-results/
playwright-report/
```

## Baseline Tests to Implement

### search-form.spec.ts — Form rendering and basic interaction

- [ ] Page loads and form `#AMCSDInterfaceForm` is visible
- [ ] Mineral input (`#txt_mineral`) accepts text
- [ ] Author input (`#txt_author`) accepts text
- [ ] Chemistry includes/excludes inputs are present
- [ ] Cell parameter fields (a, b, c, alpha, beta, gamma) are present
- [ ] Search button is visible and clickable
- [ ] Full-page screenshot baseline of form in default state

### periodic-table.spec.ts — Periodic table interactions

- [ ] Chemistry link toggles periodic table visibility
- [ ] Clicking an element highlights it and populates chemistry includes field
- [ ] Clicking a highlighted element deselects it
- [ ] Multiple elements can be selected
- [ ] Screenshot of periodic table in open state

### cell-parameters.spec.ts — Cell parameter validation

- [ ] Numeric values accepted in cell parameter fields
- [ ] Non-numeric values rejected or flagged
- [ ] Range inputs (min/max) work correctly

### search-submission.spec.ts — Search query construction

- [ ] Filling mineral name and submitting constructs correct base64 query
- [ ] Combined search (mineral + chemistry + cell params) builds correct query
- [ ] Verify redirect URL contains expected encoded parameters
- [ ] Test with known mineral name (e.g., "Quartz") to verify form flow

### visual-regression.spec.ts — Screenshot comparisons

- [ ] Default form state matches baseline
- [ ] Form with periodic table open matches baseline
- [ ] Form with filled fields matches baseline
- [ ] Mobile viewport screenshot baseline

## Example Test (starter template)

```ts
import { test, expect } from '@playwright/test';

test.describe('AMCSD Search Form', () => {
  test.beforeEach(async ({ page }) => {
    await page.goto('/');
  });

  test('form renders with all sections', async ({ page }) => {
    await expect(page.locator('#AMCSDInterfaceForm')).toBeVisible();
    await expect(page.locator('#txt_mineral')).toBeVisible();
    await expect(page.locator('#txt_author')).toBeVisible();
    await expect(page.locator('#txt_chemistry_incl')).toBeVisible();
    await expect(page.locator('#txt_chemistry_excl')).toBeVisible();
  });

  test('mineral input accepts text', async ({ page }) => {
    await page.fill('#txt_mineral', 'Quartz');
    await expect(page.locator('#txt_mineral')).toHaveValue('Quartz');
  });

  test('screenshot - default form state', async ({ page }) => {
    await expect(page.locator('#AMCSDMainContent')).toHaveScreenshot('default-form.png');
  });
});
```

## Notes

- Tests are read-only against the site — they fill forms and verify UI behavior but don't modify data
- The `baseURL` should be updated to point to the sandboxed VM once available
- Visual regression screenshots will need initial baselines generated with `--update-snapshots`
- Consider adding `webServer` config to Playwright if the sandbox can be started programmatically
