# API Routes
<details>
<summary>USER</summary>
<p>
## user

> /user/requestOtp
```python
{
  "apiKey" : "<API_KEY>",
  "mobile" : "<MOB_NO>"
}
```
> /user/verifyOtp
```python
{
  "apiKey" : "<API_KEY>",
  "mobile" : "<MOB_NO>",
  "otp"    : "<OTP_RECIEVED>"
}
```
> /user/register
```python
{
  "apiKey"         : "<API_KEY>",
  "name"           : "<DATA>",
  "mobile"         : "<DATA>",
  "name"           : "<DATA>",
  "gender"         : "<DATA>",
  "dob"            : "<DATA>",
  "user_type"      : "<DATA>",
  "medical_number" : "<DATA>",
  "hospital_name"  : "<DATA>",
  "email"          : "<DATA>"
}
```
> /user/getProfile
```python
{
  "apiKey"  : "<API_KEY>",
  "user_id" : "<USER_ID>",
}
```
</p>
</details>

<details>
<summary>DOCUMENT</summary>
<p>
## document

> /document/upload
```python
{
"apiKey": "<API_KEY>",
"file"   : "<FILE>"
}
```

> /document/download
```python
{
"apiKey": "<API_KEY>",
"id"    : "<DOCUMENT_ID>"
}
```
</p>
</details>

<details>
<summary>PATIENT</summary>
<p>
## patient

> /patient/add
```python
{
"apiKey"      : "<API_KEY>",
"user_id"     : "<ID>",
"name"        : "<PATIENT_NAME>",
"mobile"      : "<PATIENT_MOBILE>",
"category"    : "<MAIN_CATEGORY>",
"subCategory" : "<SUB_CATEGORY>",
"doc_ids"     : "<DOC_IDS_SEPERATED_BY_COMMA>",
}
```
> /patient/update
```python
{
"apiKey"      : "<API_KEY>",
"patient_id"  : "<PATIENT_ID>",
"name"        : "<PATIENT_NAME>",
"mobile"      : "<PATIENT_MOBILE>",
"doc_ids"     : "<DOC_IDS_SEPERATED_BY_COMMA>",
}
```
> /patient/delete
```python
{
"apiKey"       : "<API_KEY>",
"patient_id"   : "<PATIENT_ID>",
}
```
> /patient/getHistory
```python
{
"apiKey"      : "<API_KEY>",
"user_id"     : "<USER_ID>",
}
```
</p>
</details>

<details>
<summary>HOME PAGE</summary>
<p>
## homepage

> /homePage
```python
{
"apiKey"    : "<API_KEY>",
"user_id"   : "<USER_ID>"
}
```
</p>
</details>

<details>
<summary>ADMIN</summary>
<p>
## ADMIN

> /admin/dashboard
```python
{
"apiKey"    : "<API_KEY>",
}
```
> /admin/allowDoctor
```python
{
"apiKey"    : "<API_KEY>",
"user_id"   : "<DATA>",
}
```
</p>
</details>
