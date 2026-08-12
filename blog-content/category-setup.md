# Category setup & post remaps

## Create categories

| Name | Slug | Description (optional) |
|------|------|------------------------|
| Education | `education` | Ontario rules, responsible use, how legal cannabis retail works |
| Strains & Products | `strains-products` | Factual guides to product formats and types |
| Local Events | `local-events` | 19+ in-store educational events |
| Guides | `guides` | Practical how-tos |
| Oshawa & Durham | `oshawa-durham` | Local information for Oshawa and Durham Region customers |

## Remap existing posts

| Post ID | Title | Remove | Add |
|---------|-------|--------|-----|
| 104888 | THC/MG Limits | Blog (1) | Education, Guides |
| 104885 | What is Flow Through? | Blog (1) | Education, Strains & Products |
| 104896 | Rosin, Resin & Distillate | Blog (1) | Strains & Products, Education |

Suggested tags:
- 104888: `thc-limits`, `ontario`, `responsible-use`
- 104885: `flow-through`, `ocs`, `ontario`
- 104896: `concentrates`, `rosin`, `resin`, `distillate`

## After remapping
Delete empty category **Blog** (id 1) so `/category/blog/` does not linger in the sitemap.
