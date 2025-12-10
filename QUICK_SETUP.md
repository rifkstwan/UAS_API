# Quick Setup - 5 Minutes

## 🚀 TL;DR - Just Run These Commands

```bash
# 1. Pull latest code (duplicate migrations sudah dihapus)
git pull origin main

# 2. Fresh setup
rm -f database/database.sqlite  # If using SQLite
php artisan migrate --fresh

# 3. Install Passport
php artisan passport:install

# 4. Create M2M OAuth Client
php artisan passport:client --client
# Answer: GoApi M2M Client, pick user 0
# SAVE THE CLIENT ID AND SECRET!

# 5. Run server
php artisan serve

# 6. In another terminal, test:
curl -X POST http://localhost:8000/api/oauth/token \
  -H "Content-Type: application/json" \
  -d '{
    "grant_type": "client_credentials",
    "client_id": "3",
    "client_secret": "YOUR_SECRET_HERE",
    "scope": ""
  }'

# 7. Copy the access_token from response, then test:
curl -X GET "http://localhost:8000/api/weather?city=Jakarta" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

## 퉰x️ Common Issues

| Issue | Solution |
|-------|----------|
| "table oauth_auth_codes already exists" | ✅ Fixed! Duplicate migrations deleted. Just do `git pull` |
| "Unauthenticated" when accessing API | Add `-H "Authorization: Bearer {token}"` to your curl |
| "Invalid client credentials" | Check that client_id and client_secret are correct |
| "database is locked" | `rm database/database.sqlite && php artisan migrate --fresh` |

## 📊 Files to Check

- `PASSPORT_SETUP_FINAL.md` - Complete guide
- `SETUP_INSTRUCTIONS.md` - Detailed walkthrough  
- `routes/api.php` - API routes definition
- `app/Http/Controllers/Api/GoApiController.php` - Endpoint implementations
- `.env.example` - Environment template

## ✅ Test All 4 Endpoints

```bash
# 1. Weather
curl http://localhost:8000/api/weather?city=Jakarta \
  -H "Authorization: Bearer TOKEN"

# 2. Currency  
curl http://localhost:8000/api/currency?from=USD&to=IDR \
  -H "Authorization: Bearer TOKEN"

# 3. News
curl http://localhost:8000/api/news?category=technology \
  -H "Authorization: Bearer TOKEN"

# 4. Post Data
curl -X POST http://localhost:8000/api/data \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"payload": {"test": "data"}}'
```

**If all 4 endpoints return data, you're done with Passport setup! ✅**

Next: Create Swagger and Flow documentation for UAS submission.
