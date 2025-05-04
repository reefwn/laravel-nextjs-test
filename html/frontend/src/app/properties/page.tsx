// app/properties/page.tsx
'use client';

import { useEffect, useState } from 'react';
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Label } from "@/components/ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { API_BASE } from '@/lib/api';

type GeoLocation = {
  country: string;
  province: string;
  street: string;
};

type PhotoSet = {
  thumb: string;
  search: string;
  full: string;
};

type Property = {
  id: number;
  title: string;
  description: string;
  price: string;
  geo_location: GeoLocation;
  photo_set: PhotoSet;
};

export default function PropertiesPage() {
  const [properties, setProperties] = useState<Property[]>([]);
  const [loading, setLoading] = useState(false);
  const [title, setTitle] = useState('');
  const [location, setLocation] = useState('');
  const [sort, setSort] = useState('');
  const [page, setPage] = useState(1);
  const [pagination, setPagination] = useState<{
    next_page_url: string | null;
    prev_page_url: string | null;
  }>({ next_page_url: null, prev_page_url: null });


  const fetchProperties = async () => {
    setLoading(true);
    const query = new URLSearchParams();
    if (title) query.append('title', title);
    if (location) query.append('location', location);
    if (sort) query.append('sort', sort);
    query.append('page', page.toString());

    try {
      const res = await fetch(`${API_BASE}/api/properties?${query.toString()}`);
      const data = await res.json();
      setProperties(data.data);
      setPagination({
        next_page_url: data.next_page_url,
        prev_page_url: data.prev_page_url,
      });
    } catch (error) {
      console.error('Error fetching properties:', error);
      setProperties([]);
      setPagination({ next_page_url: null, prev_page_url: null });
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchProperties();
  }, [title, location, sort, page]);

  return (
    <div className="max-w-5xl mx-auto p-4">
      <h1 className="text-2xl font-bold mb-4">Browse Properties</h1>

      <div className="flex flex-col md:flex-row gap-4 mb-6">
        <div className="flex-1">
          <Label htmlFor="title">Title</Label>
          <Input id="title" value={title} onChange={(e) => setTitle(e.target.value)} />
        </div>

        <div className="flex-1">
          <Label htmlFor="location">Location</Label>
          <Input id="location" value={location} onChange={(e) => setLocation(e.target.value)} />
        </div>

        <div className="flex-1">
          <Label>Sort by</Label>
          <Select onValueChange={setSort} value={sort}>
            <SelectTrigger>
              <SelectValue placeholder="Select sort" />
            </SelectTrigger>
            <SelectContent>
              <SelectItem value="price">Price</SelectItem>
              <SelectItem value="-price">Price (desc)</SelectItem>
              <SelectItem value="created_at">Created At</SelectItem>
              <SelectItem value="-created_at">Created At (desc)</SelectItem>
            </SelectContent>
          </Select>
        </div>

        <div className="flex items-end">
          <Button onClick={fetchProperties}>Search</Button>
        </div>
      </div>

      {loading ? (
        <p>Loading...</p>
      ) : !properties || properties?.length === 0 ? (
        <div className="text-center text-muted-foreground mt-12">
          <p className="text-xl font-semibold">No properties found</p>
          <p className="text-sm mt-2">Try adjusting your filters or search terms.</p>
        </div>
      ) : (
        <div>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {properties?.map((property) => (
              <Card key={property.id}>
                <img src={property.photo_set?.thumb || '/placeholder.jpg'} alt={property.title} className="rounded-t-md w-full h-40 object-cover" />
                <CardContent className="p-4">
                  <h2 className="text-lg font-semibold">{property.title}</h2>
                  <p className="text-sm text-muted-foreground mb-2">{property.geo_location?.province}, {property.geo_location?.country}</p>
                  <p className="text-md font-bold text-green-600">{property.price} ฿</p>
                  <p className="text-sm mt-2">{property.description.substring(0, 100)}...</p>
                </CardContent>
              </Card>
            ))}
          </div>
          <div className="flex justify-center mt-6 space-x-4">
            <Button
              variant="outline"
              disabled={!pagination.prev_page_url}
              onClick={() => {
                setPage((prev) => prev - 1);
              }}
            >
              Previous
            </Button>

            <Button
              variant="outline"
              disabled={!pagination.next_page_url}
              onClick={() => {
                setPage((prev) => prev + 1);
              }}
            >
              Next
            </Button>
          </div>
        </div>
      )}
    </div>
  );
}
